# Quick Deployment Guide

## ✅ Deployment Package Ready!

Your theme has been built and packaged. The deployment ZIP file is ready:

**📦 File:** `devengine-premium.zip`

## Installation Steps

### Method 1: WordPress Admin (Recommended)

1. **Log in** to your WordPress admin dashboard
2. Navigate to **Appearance → Themes → Add New**
3. Click **Upload Theme** button at the top
4. Click **Choose File** and select `devengine-premium.zip`
5. Click **Install Now**
6. Click **Activate** after installation completes

### Method 2: FTP/SFTP Upload

1. **Extract** the ZIP file on your computer
2. **Connect** to your server via FTP/SFTP (FileZilla, WinSCP, etc.)
3. Navigate to `wp-content/themes/` directory
4. **Upload** the entire `devengine-premium` folder
5. **Set permissions:**
   - Folders: 755
   - Files: 644
6. **Activate** the theme in WordPress admin: Appearance → Themes

### Method 3: cPanel File Manager

1. **Log in** to cPanel
2. Open **File Manager**
3. Navigate to `public_html/wp-content/themes/`
4. Click **Upload** and select `devengine-premium.zip`
5. **Right-click** the ZIP file → **Extract**
6. **Delete** the ZIP file after extraction
7. **Activate** in WordPress admin

## Post-Installation Configuration

### 1. Configure Theme Settings

Go to **Appearance → Customize**:

- **Design System**: Set colors, typography, dark mode
- **GitHub Integration**: Enter your GitHub username
- **Header & Navigation**: Configure header settings

### 2. Set Up Menus

1. Go to **Appearance → Menus**
2. Create a new menu for **Primary Navigation**
3. Create a menu for **Footer Navigation**
4. Assign menus to their locations

### 3. Create Content

- **Projects**: Posts → Projects → Add New
- **Snippets**: Posts → Snippets → Add New
- **Use Block Patterns**: In editor, click + → Patterns → DevEngine Patterns

## Requirements

- ✅ WordPress 6.5 or higher
- ✅ PHP 8.1 or higher
- ✅ No additional plugins required

## Troubleshooting

**White Screen?**
- Check PHP version (needs 8.1+)
- Enable WP_DEBUG in wp-config.php
- Check error logs

**Styles Not Loading?**
- Clear browser cache
- Clear WordPress cache (if using caching plugin)
- Verify `/dist/css/main.css` exists

**Blocks Not Showing?**
- Go to Settings → Permalinks → Save (flush rewrite rules)
- Clear WordPress transients

## Support

For detailed deployment instructions, see `DEPLOYMENT.md`

---

**Theme Version:** 1.0.0  
**Package Created:** $(Get-Date -Format "yyyy-MM-dd HH:mm")

