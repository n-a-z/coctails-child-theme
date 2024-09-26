# Hello Child theme for Coctails

## Custom Post Type: 'Cocktails'
A new custom post type called "Cocktails" has been created for managing cocktail-related content.

## Custom Fields using ACF
Relevant custom fields have been set up to display detailed information about a single cocktail, such as name, ingredients, instructions, and more, based on requirements.

## API Integration Script
A PHP script has been written to populate the "Cocktails" custom post type with data from the CocktailDB API (https://www.thecocktaildb.com/api/json/v1/1/search.php?s=). This script pulls entries based on a search query, such as cocktail name or ingredients, and populates the custom post type with the corresponding cocktail details.

## Archive Page with Categorization
An archive page has been created to display all cocktails in a categorized manner. The categorization method can be based on factors like ingredients, types of drinks, or other categories.

## Single Cocktail Page Template
A custom template for a "single_cocktail" page has been created. This page displays the detailed information of a specific cocktail when selected from the archive page.

## Ingredient Filter with jQuery
A jQuery-powered filter has been added to the archive page, allowing users to filter cocktails by the first ingredient without a page reload for a smooth user experience.