# DevEngine Premium - Build and Package Script for Windows
# This script builds assets and creates a deployment-ready ZIP file

Write-Host "🚀 DevEngine Premium - Build & Package Script" -ForegroundColor Cyan
Write-Host "=============================================" -ForegroundColor Cyan
Write-Host ""

# Step 1: Check if Node.js is installed
Write-Host "📦 Step 1: Checking prerequisites..." -ForegroundColor Yellow
try {
    $nodeVersion = node --version
    Write-Host "✅ Node.js found: $nodeVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ Node.js not found. Please install Node.js 18+ first." -ForegroundColor Red
    exit 1
}

# Step 2: Install dependencies if needed
Write-Host ""
Write-Host "📦 Step 2: Installing dependencies..." -ForegroundColor Yellow
if (-not (Test-Path "node_modules")) {
    Write-Host "Installing npm packages..." -ForegroundColor Gray
    npm install
    if ($LASTEXITCODE -ne 0) {
        Write-Host "❌ npm install failed!" -ForegroundColor Red
        exit 1
    }
    Write-Host "✅ Dependencies installed" -ForegroundColor Green
} else {
    Write-Host "✅ Dependencies already installed" -ForegroundColor Green
}

# Step 3: Build assets
Write-Host ""
Write-Host "🔨 Step 3: Building production assets..." -ForegroundColor Yellow
npm run build
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Build failed!" -ForegroundColor Red
    exit 1
}
Write-Host "✅ Assets built successfully" -ForegroundColor Green

# Step 4: Create temporary distribution directory
Write-Host ""
Write-Host "📁 Step 4: Preparing distribution package..." -ForegroundColor Yellow

$distDir = "devengine-premium-dist"
$zipFile = "devengine-premium.zip"

# Remove old distribution if exists
if (Test-Path $distDir) {
    Remove-Item -Recurse -Force $distDir
    Write-Host "Cleaned old distribution directory" -ForegroundColor Gray
}

# Create new distribution directory
New-Item -ItemType Directory -Path $distDir | Out-Null

# Files and folders to include
$includeItems = @(
    "404.php",
    "archive.php",
    "blocks",
    "composer.json",
    "footer.php",
    "functions.php",
    "header.php",
    "index.php",
    "inc",
    "languages",
    "page.php",
    "parts",
    "readme.txt",
    "search.php",
    "single.php",
    "single-devengine_project.php",
    "style.css",
    "theme.json",
    "dist",
    "assets"
)

# Copy included items
foreach ($item in $includeItems) {
    if (Test-Path $item) {
        Copy-Item -Path $item -Destination $distDir -Recurse -Force
        Write-Host "  ✓ Copied: $item" -ForegroundColor Gray
    } else {
        Write-Host "  ⚠ Missing: $item (skipping)" -ForegroundColor Yellow
    }
}

# Create empty directories that might be needed
$emptyDirs = @(
    "$distDir\dist\css",
    "$distDir\dist\js"
)

foreach ($dir in $emptyDirs) {
    if (-not (Test-Path $dir)) {
        New-Item -ItemType Directory -Path $dir -Force | Out-Null
        New-Item -ItemType File -Path "$dir\.gitkeep" -Force | Out-Null
    }
}

Write-Host "✅ Distribution directory prepared" -ForegroundColor Green

# Step 5: Create ZIP file
Write-Host ""
Write-Host "📦 Step 5: Creating ZIP archive..." -ForegroundColor Yellow

# Remove old ZIP if exists
if (Test-Path $zipFile) {
    Remove-Item -Force $zipFile
    Write-Host "Removed old ZIP file" -ForegroundColor Gray
}

# Create ZIP using .NET compression
Add-Type -AssemblyName System.IO.Compression.FileSystem
[System.IO.Compression.ZipFile]::CreateFromDirectory($distDir, $zipFile)

$zipSize = (Get-Item $zipFile).Length / 1MB
Write-Host "✅ ZIP file created: $zipFile ($([math]::Round($zipSize, 2)) MB)" -ForegroundColor Green

# Step 6: Cleanup
Write-Host ""
Write-Host "🧹 Step 6: Cleaning up..." -ForegroundColor Yellow
Remove-Item -Recurse -Force $distDir
Write-Host "✅ Cleanup complete" -ForegroundColor Green

# Final summary
Write-Host ""
Write-Host "=============================================" -ForegroundColor Cyan
Write-Host "✅ BUILD COMPLETE!" -ForegroundColor Green
Write-Host ""
Write-Host "📦 Deployment package: $zipFile" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Upload $zipFile to your WordPress site" -ForegroundColor White
Write-Host "2. Go to Appearance Themes Add New Upload Theme" -ForegroundColor White
Write-Host "3. Select the ZIP file and install" -ForegroundColor White
Write-Host "4. Activate the theme" -ForegroundColor White
Write-Host ""
Write-Host "For detailed instructions, see DEPLOYMENT.md" -ForegroundColor Gray
Write-Host ""

