/**
 * File Validation Utility with Toast Messages
 */
window.FileValidator = {
    /**
     * Validate file size
     * @param {File} file - The file to validate
     * @param {number} maxSizeInBytes - Maximum allowed size in bytes (default: 2MB)
     * @returns {boolean} - True if valid, false otherwise
     */
    validateSize: function(file, maxSizeInBytes = 2097152) { // 2MB default
        if (file.size > maxSizeInBytes) {
            const maxSizeMB = (maxSizeInBytes / 1024 / 1024).toFixed(1);
            Toast.warning(`File size must not exceed ${maxSizeMB}MB.`);
            return false;
        }
        return true;
    },

    /**
     * Validate file type
     * @param {File} file - The file to validate
     * @param {Array} allowedTypes - Array of allowed MIME types
     * @returns {boolean} - True if valid, false otherwise
     */
    validateType: function(file, allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml']) {
        if (!allowedTypes.includes(file.type)) {
            const allowedExtensions = allowedTypes.map(type => {
                switch(type) {
                    case 'image/png': return 'PNG';
                    case 'image/jpeg': 
                    case 'image/jpg': return 'JPEG';
                    case 'image/svg+xml': return 'SVG';
                    case 'application/pdf': return 'PDF';
                    case 'application/msword': return 'DOC';
                    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': return 'DOCX';
                    default: return type;
                }
            }).filter((value, index, self) => self.indexOf(value) === index);
            
            Toast.warning(`File type must be ${allowedExtensions.join(', ')}.`);
            return false;
        }
        return true;
    },

    /**
     * Validate file with both size and type checks
     * @param {File} file - The file to validate
     * @param {Object} options - Validation options
     * @param {number} options.maxSize - Maximum size in bytes
     * @param {Array} options.allowedTypes - Array of allowed MIME types
     * @returns {boolean} - True if valid, false otherwise
     */
    validate: function(file, options = {}) {
        const maxSize = options.maxSize || 2097152; // 2MB default
        const allowedTypes = options.allowedTypes || ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
        
        return this.validateSize(file, maxSize) && this.validateType(file, allowedTypes);
    },

    /**
     * Setup file input validation
     * @param {string} selector - CSS selector for file input
     * @param {Object} options - Validation options
     */
    setupValidation: function(selector, options = {}) {
        $(selector).on('change', function(e) {
            const file = this.files[0];
            
            if (file) {
                if (!FileValidator.validate(file, options)) {
                    $(this).val('');
                    // Reset custom file input label if using Bootstrap
                    if (typeof bsCustomFileInput !== 'undefined') {
                        bsCustomFileInput.destroy();
                        bsCustomFileInput.init();
                    }
                    return false;
                }
            }
        });
    }
};