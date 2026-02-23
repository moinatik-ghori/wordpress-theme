# DevEngine Premium - Deployment Guide

## Prerequisites

Before deploying, ensure you have:

- **WordPress 6.5+** installed
- **PHP 8.1+** enabled
- **Node.js 18+** and **npm** (for building assets)
- **Composer** (for PHP dependencies)

## Step 1: Local Testing & Build

### 1.1 Install Dependencies

```bash
# Install Node.js dependencies
npm install

# Install PHP dependencies (optional, for linting)
composer install
```

### 1.2 Build Assets

```bash
# Production build (minified, optimized)
npm run build

# Development build with watch mode
npm run dev
```

This will:
- Compile SCSS to CSS in `/dist/css/`
- Bundle JavaScript in `/dist/js/`
- Generate source maps for debugging

### 1.3 Test Locally

1. **Set up local WordPress environment** (XAMPP, Local by Flywheel, or similar)
2. **Copy theme folder** to `wp-content/themes/devengine-premium/`
3. **Activate theme** in WordPress admin: Appearance > Themes
4. **Test features:**
   - Navigate to Appearance > Customize
   - Configure GitHub username
   - Test dark mode toggle
   - Create test posts/projects
   - Test custom blocks in editor

### 1.4 Run Linters

```bash
# Check PHP code standards
npm run lint:php

# Check SCSS code standards
npm run lint:scss
```

## Step 2: Pre-Deployment Checklist

- [ ] All assets built (`npm run build`)
- [ ] No linting errors
- [ ] Tested on local WordPress 6.5+
- [ ] Tested with PHP 8.1+
- [ ] Custom blocks working in editor
- [ ] GitHub API integration tested
- [ ] Dark mode toggle functional
- [ ] Mobile menu working
- [ ] All templates rendering correctly
- [ ] Screenshot added (replace placeholder)

## Step 3: Create Distribution Package

### 3.1 Remove Development Files

Create a clean distribution by excluding:
- `node_modules/`
- `src/` (source files - already compiled to `dist/`)
- `.git/`
- Development config files

### 3.2 Create ZIP File

**Option A: Manual ZIP**
1. Select all theme files EXCEPT:
   - `node_modules/`
   - `.git/`
   - `src/` (keep `dist/` with compiled assets)
   - `package.json`, `package-lock.json`
   - `composer.json`, `composer.lock`
   - `vite.config.js`, `bs-config.js`
   - `.phpcsrc.xml`, `.stylelintrc.json`
   - `.gitignore`
2. Create ZIP: `devengine-premium.zip`

**Option B: Automated Script**

Create `build-zip.sh` (Linux/Mac) or `build-zip.ps1` (Windows):

```bash
#!/bin/bash
# build-zip.sh

# Clean previous build
rm -f devengine-premium.zip

# Create temporary directory
mkdir -p dist-theme
cp -r . dist-theme/

# Remove development files
cd dist-theme
rm -rf node_modules .git src .vscode .idea
rm -f package.json package-lock.json composer.json composer.lock
rm -f vite.config.js bs-config.js .phpcsrc.xml .stylelintrc.json .gitignore
rm -f README.md FILE_STRUCTURE.md DEPLOYMENT.md

# Create ZIP
cd ..
zip -r devengine-premium.zip dist-theme/*
rm -rf dist-theme

echo "✅ Theme ZIP created: devengine-premium.zip"
```

## Step 4: Deploy to Production

### 4.1 Upload via WordPress Admin

1. **Log in** to your WordPress admin dashboard
2. Navigate to **Appearance > Themes > Add New**
3. Click **Upload Theme**
4. Choose `devengine-premium.zip`
5. Click **Install Now**
6. Click **Activate**

### 4.2 Upload via FTP/SFTP

1. **Extract ZIP** on your computer
2. **Connect** to your server via FTP/SFTP
3. **Navigate** to `wp-content/themes/`
4. **Upload** entire `devengine-premium` folder
5. **Set permissions** (folders: 755, files: 644)
6. **Activate** in WordPress admin

### 4.3 Upload via cPanel File Manager

1. **Log in** to cPanel
2. Open **File Manager**
3. Navigate to `public_html/wp-content/themes/`
4. Click **Upload**
5. Select `devengine-premium.zip`
6. **Extract** the ZIP file
7. **Activate** in WordPress admin

## Step 5: Post-Deployment Configuration

### 5.1 Configure Theme Settings

1. **Appearance > Customize > Design System**
   - Set color scheme
   - Configure typography
   - Enable/disable dark mode toggle

2. **Appearance > Customize > GitHub Integration**
   - Enter GitHub username
   - (Optional) Add Personal Access Token
   - Set number of repos to display

3. **Appearance > Customize > Header & Navigation**
   - Configure sticky header
   - Set CTA button text/URL
   - Adjust logo height

### 5.2 Set Up Menus

1. **Appearance > Menus**
2. Create **Primary Navigation** menu
3. Create **Footer Navigation** menu
4. Assign to respective locations

### 5.3 Create Content

1. **Add Projects**: Posts > Projects > Add New
   - Fill in project meta fields
   - Add tech stack tags
   - Set featured image

2. **Add Snippets**: Posts > Snippets > Add New
   - Set language and difficulty
   - Add code examples

3. **Use Block Patterns**: 
   - In page/post editor, click **+** > **Patterns**
   - Browse **DevEngine Patterns**
   - Insert Hero Code Split, Experience Timeline, or Project Bento Grid

### 5.4 Test Custom Blocks

1. **GitHub Repo Card Block**:
   - Add block in editor
   - Enter username and repo name
   - Click "Fetch Preview"
   - Publish and verify on frontend

2. **Tech Stack Badge Block**:
   - Add block
   - Select technology
   - Choose size and icon visibility

## Step 6: Performance Optimization

### 6.1 Enable Caching

Install a caching plugin:
- **WP Super Cache**
- **W3 Total Cache**
- **WP Rocket** (premium)

### 6.2 Optimize Images

- Use **WebP** format where possible
- Compress images before upload
- Consider **Smush** or **ShortPixel** plugin

### 6.3 CDN Setup (Optional)

- Configure **Cloudflare** or similar CDN
- Point static assets (CSS/JS) to CDN

## Step 7: Security Hardening

The theme includes built-in security features:
- ✅ HTTP security headers
- ✅ XSS protection
- ✅ CSRF protection
- ✅ User enumeration prevention
- ✅ File editing disabled

**Additional recommendations:**
- Use **Wordfence** or **Sucuri** security plugin
- Enable **SSL/HTTPS**
- Keep WordPress and plugins updated
- Use strong passwords
- Limit login attempts

## Step 8: Troubleshooting

### Issue: White Screen / Fatal Error

**Solution:**
1. Check PHP error logs
2. Verify PHP 8.1+ is active
3. Check `wp-config.php` has `WP_DEBUG` enabled
4. Verify all files uploaded correctly

### Issue: Styles Not Loading

**Solution:**
1. Run `npm run build` to compile assets
2. Verify `dist/css/main.css` exists
3. Clear browser cache
4. Clear WordPress cache (if using caching plugin)

### Issue: JavaScript Not Working

**Solution:**
1. Check browser console for errors
2. Verify `dist/js/theme-core.js` exists
3. Check file permissions (644 for files)
4. Verify no JavaScript errors in console

### Issue: GitHub API Not Working

**Solution:**
1. Verify GitHub username in Customizer
2. Check API rate limits (60/hour without token)
3. Add Personal Access Token if needed
4. Check browser console for API errors

### Issue: Blocks Not Showing in Editor

**Solution:**
1. Clear WordPress transients: `wp transient delete --all`
2. Regenerate permalinks: Settings > Permalinks > Save
3. Check block.json files are valid
4. Verify theme is activated

## Step 9: Maintenance

### Regular Updates

1. **Backup** before updates
2. **Test** updates on staging first
3. **Monitor** error logs
4. **Update** WordPress core regularly

### Monitoring

- Check **Site Health**: Tools > Site Health
- Monitor **Performance**: Use GTmetrix or PageSpeed Insights
- Review **Error Logs**: Check server error logs regularly

## Quick Reference Commands

```bash
# Development
npm install              # Install dependencies
npm run dev             # Start dev server with watch
npm run build           # Production build
npm run lint:php        # Check PHP code
npm run lint:scss       # Check SCSS code

# WordPress CLI (if installed)
wp theme activate devengine-premium
wp transient delete --all
wp rewrite flush
```

## Support

For issues or questions:
1. Check this deployment guide
2. Review WordPress error logs
3. Check browser console for JavaScript errors
4. Verify all prerequisites are met

---

**Theme Version:** 1.0.0  
**Last Updated:** 2024-01-15  
**WordPress Required:** 6.5+  
**PHP Required:** 8.1+

