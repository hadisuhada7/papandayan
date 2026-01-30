# Global Toast Message System

This system provides a unified way to display toast notifications across your Laravel AdminLTE application.

## Components

### 1. AdminLTE Plugin Configuration (`config/adminlte.php`)
Added Toastr plugin that can be enabled on any page:
```php
'Toastr' => [
    'active' => false,
    'files' => [
        // CSS and JS files for toastr
    ],
],
```

### 2. Global Toast Partial (`resources/views/partials/toastr.blade.php`)
- Configures toastr options globally
- Automatically displays session flash messages
- Provides global `Toast` utility functions
- Shows validation errors as toast notifications

### 3. Flash Message Trait (`app/Http/Traits/FlashMessageTrait.php`)
Provides helper methods for controllers:
- `flashSuccess($message)` - Flash success message
- `flashError($message)` - Flash error message
- `flashWarning($message)` - Flash warning message
- `flashInfo($message)` - Flash info message
- `redirectWithSuccess($route, $message)` - Redirect with success
- `redirectWithError($route, $message)` - Redirect with error
- `redirectBackWithError($message)` - Go back with error

### 4. File Validator Utility (`public/js/file-validator.js`)
JavaScript utility for client-side file validation with toast messages:
- `FileValidator.validate(file, options)` - Validate file
- `FileValidator.setupValidation(selector, options)` - Setup automatic validation
- Supports size and type validation

## Usage

### In Blade Templates

1. **Enable Toastr plugin:**
```blade
@section('plugins.Toastr', true)
```

2. **Include the global toast partial in your JavaScript section:**
```blade
@section('js')
    @include('partials.toastr')
    <script>
        // Your custom JS here
    </script>
@stop
```

3. **Use client-side toast functions:**
```javascript
// Manual toast calls
Toast.success('Operation completed successfully!');
Toast.error('Something went wrong!');
Toast.warning('Please check your input!');
Toast.info('Information message');

// File validation setup
FileValidator.setupValidation('#file-input', {
    maxSize: 2097152, // 2MB
    allowedTypes: ['image/png', 'image/jpeg', 'image/jpg']
});
```

### In Controllers

1. **Use the FlashMessageTrait:**
```php
use App\Http\Traits\FlashMessageTrait;

class YourController extends Controller
{
    use FlashMessageTrait;
    
    public function store(Request $request)
    {
        try {
            // Your logic here
            return $this->redirectWithSuccess('admin.index', 'Created successfully!');
        } catch (\Exception $e) {
            return $this->redirectBackWithError('Failed to create. Please try again.');
        }
    }
}
```

2. **Traditional flash messages (also works):**
```php
return redirect()->route('admin.index')->with('success', 'Message here');
```

### Session Flash Message Types

The system automatically displays these session flash types:
- `success` - Green toast
- `error` - Red toast  
- `warning` - Orange toast
- `info` - Blue toast

### File Validation Options

```javascript
FileValidator.setupValidation('#input-id', {
    maxSize: 2097152,        // 2MB in bytes
    allowedTypes: [          // Allowed MIME types
        'image/png',
        'image/jpeg', 
        'image/jpg',
        'image/svg+xml',
        'application/pdf'
    ]
});
```

## Example Implementation

```blade
@extends('adminlte::page')

@section('title', 'Your Page')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Toastr', true)

@section('content')
    <!-- Your content -->
@stop

@section('js')
    <script src="{{ asset('js/file-validator.js') }}"></script>
    @include('partials.toastr')
    <script>
        $(document).ready(function() {
            // Initialize components
            bsCustomFileInput.init();
            
            // Setup file validation
            FileValidator.setupValidation('#file-input');
            
            // Manual toast example
            $('#test-button').click(function() {
                Toast.success('Button clicked!');
            });
        });
    </script>
@stop
```

## Features

✅ **Global Configuration** - Set up once, use everywhere  
✅ **Session Integration** - Automatically shows Laravel flash messages  
✅ **Error Handling** - Shows validation errors as toasts  
✅ **File Validation** - Built-in client-side file validation  
✅ **Controller Helpers** - Easy-to-use trait methods  
✅ **Consistent Styling** - Uniform toast appearance  
✅ **AdminLTE Integration** - Proper plugin system usage  

## Benefits

- **DRY Principle**: No need to repeat toast configuration
- **Consistent UX**: Same toast behavior across all pages
- **Easy Maintenance**: Central configuration and utilities
- **Error Prevention**: Built-in file validation with user feedback
- **Developer Friendly**: Simple API with helper methods