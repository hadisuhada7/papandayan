# Panduan Sistem Tag untuk Artikel

## Struktur Database

### Tabel `tags`
- `id` - Primary key
- `name` - Nama tag (unique)
- `slug` - URL-friendly versi dari nama tag (unique)
- `created_at` & `updated_at` - Timestamps

### Tabel `article_tag` (Pivot Table)
- `id` - Primary key
- `article_id` - Foreign key ke tabel articles
- `tag_id` - Foreign key ke tabel tags
- `created_at` & `updated_at` - Timestamps

## Cara Menggunakan

### 1. Menambahkan Tag ke Artikel (di Admin Panel)

Anda perlu menambahkan form untuk mengelola tags di halaman create/edit article. Contoh:

```php
// Di controller saat menyimpan artikel
$article = Article::create($data);

// Attach tags ke article
$article->tags()->attach([1, 2, 3]); // ID tags

// Atau menggunakan sync untuk replace semua tags
$article->tags()->sync([1, 2, 3]);
```

### 2. Menampilkan Tags di Frontend

Tags akan otomatis muncul di halaman detail artikel karena sudah diimplementasikan di:
- `resources/views/front/article-detail.blade.php`

### 3. Query Articles Berdasarkan Tag

```php
// Get articles dengan tag tertentu
$articles = Article::whereHas('tags', function($query) {
    $query->where('name', 'Poultry');
})->get();

// Get articles dengan multiple tags
$articles = Article::whereHas('tags', function($query) {
    $query->whereIn('name', ['Poultry', 'Travel']);
})->get();
```

### 4. Menambahkan Tag Baru Secara Manual

```php
use App\Models\Tag;
use Illuminate\Support\Str;

Tag::create([
    'name' => 'New Tag',
    'slug' => Str::slug('New Tag'),
]);
```

### 5. Popular Tags

Popular tags ditampilkan di sidebar menggunakan withCount untuk menghitung jumlah artikel per tag:

```php
$allTags = \App\Models\Tag::withCount('articles')
    ->orderBy('articles_count', 'desc')
    ->limit(10)
    ->get();
```

## File yang Telah Dimodifikasi

1. **Migration Files:**
   - `database/migrations/2026_01_31_102124_create_tags_table.php`
   - `database/migrations/2026_01_31_102151_create_article_tag_table.php`

2. **Models:**
   - `app/Models/Tag.php` - Model baru
   - `app/Models/Article.php` - Ditambahkan relasi `tags()`

3. **Controllers:**
   - `app/Http/Controllers/FrontController.php` - Method `articleDetail()` di-update untuk eager load tags

4. **Views:**
   - `resources/views/front/article-detail.blade.php` - Menampilkan tags dari database

5. **Seeders:**
   - `database/seeders/TagSeeder.php` - Seeder untuk data tags contoh

## Tips dan Best Practices

1. **Selalu gunakan slug** untuk URL-friendly tags
2. **Gunakan sync()** saat update tags untuk menghindari duplikat
3. **Eager load tags** untuk menghindari N+1 query problem: `Article::with('tags')->get()`
4. **Validasi tags** saat menyimpan artikel untuk memastikan tag ID valid

## Contoh Implementasi di Admin Panel

### Tambahkan di Form Create/Edit Article

```blade
<!-- resources/views/admin/articles/form.blade.php -->
<div class="form-group">
    <label>Tags</label>
    <select name="tags[]" class="form-control select2" multiple>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" 
                {{ (isset($article) && $article->tags->contains($tag->id)) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
</div>
```

### Update Controller

```php
// ArticleController.php

public function create()
{
    $tags = Tag::all();
    return view('admin.articles.create', compact('tags'));
}

public function store(Request $request)
{
    $article = Article::create($request->validated());
    $article->tags()->sync($request->tags);
    
    return redirect()->route('admin.articles.index');
}

public function edit($id)
{
    $article = Article::with('tags')->findOrFail($id);
    $tags = Tag::all();
    return view('admin.articles.edit', compact('article', 'tags'));
}

public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);
    $article->update($request->validated());
    $article->tags()->sync($request->tags);
    
    return redirect()->route('admin.articles.index');
}
```

## Data Tags yang Tersedia

Setelah menjalankan seeder, tags berikut sudah tersedia:
- Poultry
- Travel
- Breeder
- Feed
- Chicks
- Agriculture
- Business
- Technology
- Innovation
- Sustainability
