# Hello Infantry — WordPress Developer Assessment

## Overview

This is a WordPress theme built for a fictional agency portfolio site. The theme relies on **Advanced Custom Fields (ACF)** for content management, but it's riddled with bugs. Your task is to **find and fix** the issues.

This assessment tests real-world WordPress debugging skills — reading PHP, understanding ACF field types, template hierarchy, and common WP/ACF pitfalls.

## Setup

### Prerequisites

- [LocalWP](https://localwp.com/) (recommended) or any local WordPress environment
- WordPress 6.x
- [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin (free version)

### Installation

1. **Create a new site** in LocalWP (or your preferred local environment)
2. **Copy the theme**: Drop the `wp-content/themes/hi-developer-theme/` folder into your site's `wp-content/themes/` directory
3. **Activate the theme**: Go to Appearance → Themes and activate "Hello Infantry Developer Theme"
4. **Install ACF**: Go to Plugins → Add New, search for "Advanced Custom Fields", install and activate
5. **Import content**: Go to Tools → Import → WordPress, install the importer if prompted, then import the `dummy-content.xml` file included in this repo. Check "Download and import file attachments".
6. **Set the homepage**: Go to Settings → Reading, select "A static page", and set the Homepage to "Home"
7. **Set up the menu**: Go to Appearance → Menus, create a menu called "Primary Menu", add your pages and the Projects archive, and assign it to the "Primary" location

### ACF Field Sync

The theme includes ACF field group JSON exports in the `acf-json/` directory. Once ACF is active and the theme is set up correctly, the field groups should appear under Custom Fields → Field Groups as "Sync available".

> **Note:** One of the bugs affects ACF JSON syncing — you may need to fix that before field groups sync properly.

## The Task

This theme has **10 intentional bugs** spread across multiple template files. Your job is to:

1. Identify each bug
2. Understand what's causing it
3. Fix it properly

### Files to Focus On

| File | What It Does |
|------|-------------|
| `functions.php` | Theme setup, CPT registration, asset enqueueing |
| `front-page.php` | Homepage template (hero, services, team sections) |
| `header.php` | Site header and navigation |
| `single-project.php` | Single project template |
| `archive-project.php` | Projects archive listing |
| `page-contact.php` | Contact page template |

### Hints

- All bugs are related to **ACF usage**, **WordPress template functions**, or **theme setup**
- Some bugs will cause a **white screen** (fatal error) — check your PHP error logs
- Some bugs are **subtle** — the page loads but content is missing or wrong
- The ACF field group JSON files are your source of truth for field names and return formats
- Pay attention to ACF field **return formats** (Array vs URL vs ID)

## What We're Looking For

1. **Debugging methodology** — Can you systematically find and diagnose issues?
2. **ACF knowledge** — Do you understand field types, return formats, and repeater fields?
3. **WordPress fundamentals** — Do you understand the template hierarchy, the Loop, and post context?
4. **Clean fixes** — Are your fixes minimal, correct, and following best practices?
5. **Documentation** — Can you clearly explain what was wrong and why your fix works?

## Submission

1. **Fork** this repository
2. Fix all the bugs you can find
3. In your fork, create a `FIXES.md` file documenting:
   - Each bug you found
   - What file it was in
   - What was wrong
   - How you fixed it and why
4. Share your fork URL with us

## Rules

- **Do not rewrite the theme from scratch** — fix the bugs in place
- **Do not change the design or add features** — this is a debugging exercise
- **Do not remove ACF dependency** — the theme is intentionally ACF-driven
- You **may** add error handling or null checks where appropriate
- You **may** reference the [ACF documentation](https://www.advancedcustomfields.com/resources/)

## Questions?

If anything is unclear, reach out to your contact at Hello Infantry.
