<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf

    'public_path' => public_path(),

    'convert_entities' => true,

    'options' => [
        /**
         * The location of the DOMPDF font directory
         *
         * The location of the directory where DOMPDF will store fonts and font metrics
         * Note: This directory must exist and be writable by the webserver process.
         * *Please note the trailing slash.*
         *
         * Notes regarding fonts:
         * Additional .afm font metrics can be added by executing load_font.php from command line.
         *
         * Only the original "Base 14 fonts" are present on all pdf viewers. Additional fonts must
         * be embedded in the pdf file or the PDF may not display correctly. This can significantly
         * increase file size unless font subsetting is enabled. Before embedding a font please
         * review your rights under the font license.
         *
         * Any font specification in the source HTML is translated to the closest font available
         * in the font directory.
         *
         * The pdf standard "Base 14 fonts" are:
         * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
         * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
         * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
         * Symbol, ZapfDingbats.
         */
        "font_dir" => storage_path('fonts/'),

        /**
         * The location of the DOMPDF font cache directory
         *
         * This directory contains the cached font metrics for the fonts used by DOMPDF.
         * This directory can be the same as DOMPDF_FONT_DIR
         *
         * Note: This directory must exist and be writable by the webserver process.
         */
        "font_cache" => storage_path('fonts/'),

        /**
         * The location of a temporary directory.
         *
         * The directory specified must be writeable by the webserver process.
         * The temporary directory is required to download remote images and when
         * using the PFDLib back end.
         */
        "temp_dir" => sys_get_temp_dir(),

        /**
         * ==== IMPORTANT ====
         *
         * dompdf's "chroot": Prepends to all relative URIs, as well as prefixes all
         * file paths.
         * This is a security measure: Only files below this directory will be
         * accessed by dompdf.
         * Paths for load_html() can be relative, and are the relative file paths
         * from DOMPDF_CHROOT.
         *
         * Be sure to set this to an appropriate directory where stylesheets and images are located.
         *
         * By default it is set to your document root. You can set it to sub directory of your
         * document root, for additional security.
         *
         * Having this set right, is very important for the ability of dompdf to
         * find "relatively" linked files (stylesheets, images, etc).
         *
         * Note: Also be sure to prepend $dompdf->chroot when setting $dompdf->base_path
         * to an absolute path.
         */
        "chroot" => realpath(base_path()),

        /**
         * Whether to enable font subsetting or not.
         */
        "enable_font_subsetting" => false,

        /**
         * The PDF rendering backend to use
         *
         * Valid settings are 'PDFLib', 'CPDF' (the bundled version of PDFLib), 'GD' and 'auto'.
         * 'auto' will look for PDFLib and use it if found, or if not it will fall back on
         * the bundled CPDF class. 'GD' renders PDFs to graphic files. {@link Canvas_Factory}
         * ultimately determines which rendering class to instantiate based on this setting.
         *
         * Both PDFLib & CPDF rendering backends provide sufficient rendering capabilities
         * for dompdf, however PDFLib provides a greater number of features.
         *
         * Differences between PDFLib & CPDF rendering backends:
         * => CPDF supports all PDF destination link types: 'XYZ', 'Fit', 'FitH', 'FitV',
         * 'FitR', 'FitB', 'FitBH', 'FitBV'.
         * => CPDF has extensive font glyph debugging to aid in development.
         * => CPDF exception messages are more meaningful, and aids in debugging.
         */
        "pdf_backend" => "CPDF",

        /**
         * PDFlib license key
         *
         * If you are using a licensed, commercial version of PDFlib, specify
         * your license key here.  If you are using PDFlib-Lite or are evaluating
         * the commercial version of PDFlib, comment out this setting.
         *
         * @license http://www.pdflib.com
         *
         * If pdflib present in web server and auto or selected explicitely above,
         * a real license code must exist!
         */
        //"DOMPDF_PDFLIB_LICENSE" => "your license key here",

        /**
         * html target media view which should be rendered into pdf.
         * List of types and parsing rules for future extensions:
         * http://www.w3.org/TR/REC-html40/types.html#type-media-descriptors
         */
        "default_media_type" => "screen",

        /**
         * The default paper size.
         *
         * North America standard is "letter"; other countries generally "a4"
         *
         * @see DOMPDF_load_config::PAPER_SIZES for valid sizes ('letter', 'legal', 'A4', etc.)
         */
        "default_paper_size" => "a4",

        /**
         * The default paper orientation.
         *
         * The orientation of the page. portrait or landscape
         *
         * @see DOMPDF_load_config::ORIENTATION for valid orientations
         */
        "default_paper_orientation" => "portrait",

        /**
         * The default font family
         *
         * Used if no suitable fonts can be found. This must exist in the font folder.
         * @var string
         */
        "default_font" => "serif",

        /**
         * Image DPI setting
         *
         * This setting determines the default DPI setting for images and fonts.  The
         * DPI may be overridden for inline images by explictly setting the
         * image's width & height style attributes (i.e. if the image's native
         * width is 600 pixels and you specify the image's width as 72 points,
         * the image will have a DPI of 600 in the rendered PDF.  The DPI of
         * background images may not be overridden and is controlled entirely
         * via this parameter.
         *
         * For the purposes of DOMPDF, pixels per inch (PPI) = dots per inch (DPI).
         * If a size in html is given as px (or without unit as image size),
         * this tells the corresponding size in pt.
         * This adjusts the relative sizes to be similar to the rendering of the
         * html page in a reference browser.
         *
         * In javascript, Screen.pixelDepth() returns 24, so the pixels per inch
         * do not actually have to do anything with the display resolution.
         * In periods of transition, more and more smartphones have crazy big
         * pixels per inch numbers, up to 400+ or 500+.
         * Nevertheless, the 96 PPI hemp often used for the web layout, in the
         * region of the CSS standard of 96 CSS pixels per inch.
         * So if you want best results and a good rendering, stick to 96.
         */
        "dpi" => 96,

        /**
         * Enable embedded PHP
         *
         * If this setting is set to true then DOMPDF will automatically evaluate
         * embedded PHP contained within <script type="text/php"> ... </script> tags.
         *
         * Enabling this for documents you do not trust (e.g. arbitrary remote html
         * pages) is a security risk.  Set this option to false if you wish to process
         * untrusted documents.
         */
        "enable_php" => false,

        /**
         * Enable inline Javascript
         *
         * If this setting is set to true then DOMPDF will automatically insert
         * JavaScript code contained within <script type="text/javascript"> ... </script> tags.
         *
         * Enabling this for documents you do not trust (e.g. arbitrary remote html
         * pages) is a security risk.  Set this option to false if you wish to process
         * untrusted documents.
         */
        "enable_javascript" => true,

        /**
         * Enable inline CSS
         *
         * If this setting is set to true then DOMPDF will automatically insert
         * CSS code contained within <style> ... </style> tags.
         */
        "enable_css_float" => false,

        /**
         * Enable remote file access
         *
         * If this setting is set to true, DOMPDF will access remote sites for
         * images and CSS files as required.
         * This is required for part of test case www/test/image_variants.html through www/preset.html
         *
         * Attention!
         * This can be a security risk, in particular in combination with DOMPDF_ENABLE_PHP and
         * allowing remote access to dompdf.php or on allowing remote html code to be passed to
         * dompdf.
         */
        "enable_remote" => true,

        /**
         * A ratio applied to the fonts height to be more like browsers' line height
         */
        "font_height_ratio" => 1.1,

        /**
         * Use the HTML5 Lib parser
         *
         * Highly recommended for compatibility with html5 markup
         */
        "enable_html5_parser" => true,

        /**
         * Allows optimisation of the generated PDF when using PDFLib or CPDF.
         * Can be resource intensive so is disabled by default.
         */
        "optimize" => false,
    ],

];
