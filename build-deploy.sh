#!/bin/bash
# DevEngine Premium - Build and Package Script for Linux/Mac

echo "🚀 DevEngine Premium - Build & Package Script"
echo "============================================="
echo ""

# Step 1: Check if Node.js is installed
echo "📦 Step 1: Checking prerequisites..."
if ! command -v node &> /dev/null; then
    echo "❌ Node.js not found. Please install Node.js 18+ first."
    exit 1
fi
NODE_VERSION=$(node --version)
echo "✅ Node.js found: $NODE_VERSION"

# Step 2: Install dependencies if needed
echo ""
echo "📦 Step 2: Installing dependencies..."
if [ ! -d "node_modules" ]; then
    echo "Installing npm packages..."
    npm install
    if [ $? -ne 0 ]; then
        echo "❌ npm install failed!"
        exit 1
    fi
    echo "✅ Dependencies installed"
else
    echo "✅ Dependencies already installed"
fi

# Step 3: Build assets
echo ""
echo "🔨 Step 3: Building production assets..."
npm run build
if [ $? -ne 0 ]; then
    echo "❌ Build failed!"
    exit 1
fi
echo "✅ Assets built successfully"

# Step 4: Create temporary distribution directory
echo ""
echo "📁 Step 4: Preparing distribution package..."

DIST_DIR="devengine-premium-dist"
ZIP_FILE="devengine-premium.zip"

# Remove old distribution if exists
if [ -d "$DIST_DIR" ]; then
    rm -rf "$DIST_DIR"
    echo "Cleaned old distribution directory"
fi

# Create new distribution directory
mkdir -p "$DIST_DIR"

# Copy files and folders
echo "Copying files..."
cp -r 404.php archive.php blocks composer.json footer.php functions.php header.php index.php inc languages page.php parts readme.txt search.php single.php single-devengine_project.php style.css theme.json dist assets "$DIST_DIR" 2>/dev/null

# Create empty directories
mkdir -p "$DIST_DIR/dist/css"
mkdir -p "$DIST_DIR/dist/js"
touch "$DIST_DIR/dist/css/.gitkeep"
touch "$DIST_DIR/dist/js/.gitkeep"

echo "✅ Distribution directory prepared"

# Step 5: Create ZIP file
echo ""
echo "📦 Step 5: Creating ZIP archive..."

# Remove old ZIP if exists
if [ -f "$ZIP_FILE" ]; then
    rm -f "$ZIP_FILE"
    echo "Removed old ZIP file"
fi

# Create ZIP
cd "$DIST_DIR"
zip -r "../$ZIP_FILE" . -q
cd ..

ZIP_SIZE=$(du -h "$ZIP_FILE" | cut -f1)
echo "✅ ZIP file created: $ZIP_FILE ($ZIP_SIZE)"

# Step 6: Cleanup
echo ""
echo "🧹 Step 6: Cleaning up..."
rm -rf "$DIST_DIR"
echo "✅ Cleanup complete"

# Final summary
echo ""
echo "============================================="
echo "✅ BUILD COMPLETE!"
echo ""
echo "📦 Deployment package: $ZIP_FILE"
echo ""
echo "Next steps:"
echo "1. Upload $ZIP_FILE to your WordPress site"
echo "2. Go to Appearance > Themes > Add New > Upload Theme"
echo "3. Select the ZIP file and install"
echo "4. Activate the theme"
echo ""
echo "For detailed instructions, see DEPLOYMENT.md"
echo ""

