# Project Structure for Maya's Kitchen

- **`mkdocs.yml`**: This is the main configuration file for MkDocs. It contains settings such as the site name ("Maya's Kitchen API Documentation"), navigation structure (sections like "API Features," "API Endpoints"), theme, and plugins.

- **`docs/`**: This directory holds the documentation files, which are typically written in Markdown (`.md`) format. For "Maya's Kitchen," the key files may include:
    - `index.md`: This serves as the homepage of your site and includes sections like "Welcome to Maya's Kitchen API Documentation," "API Features," and "About Maya's Kitchen."
    - Additional Markdown files for other sections of your documentation such as "API Endpoints" (`api_endpoints.md`), "Getting Started" (`getting_started.md`), and "Contact Us" (`contact_us.md`).

- **`site/`**: This directory is created when you build the documentation site (`mkdocs build`). It contains the static HTML files and other assets for your site.

- **`overrides/`**: This directory can be used for custom theme templates or to change the look and feel of the site.

- **`assets/`**: Another directory for static assets such as images or other files you have to include in your documentation (e.g., images for "About Maya's Kitchen" or "API Features").

- **`css/`**: Use this to add custom CSS files that can override the theme styling for your site.
