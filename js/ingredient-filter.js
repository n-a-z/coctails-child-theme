(function($) {
    $(document).ready(function() {
        let ingredientList = [];
        let $filter = $('#ingredient-filter');
        let $categories = $('.category-section'); // Select all category sections

        // Collect ingredients from all .coctail-ingredients elements
        $('.coctail-ingredients').each(function() {
            let ingredients = $(this).text().trim().slice(1, -1).split(', '); // Remove parenthesis and split by comma
            ingredientList.push(...ingredients); // Spread operator to add elements to the list
        });

        // Remove duplicates from the ingredient list (case insensitive) and capitalize the first letter of each word
        ingredientList = [...new Set(ingredientList.map(item => item.toLowerCase()))]
        .map(item => item.charAt(0).toUpperCase() + item.slice(1));

        // Sort the ingredient list alphabetically
        ingredientList.sort();

        // Build the options for the filter select element
        let optionsHtml = '';
        optionsHtml += '<option value="all">All Ingredients</option>'; // Add "All Ingredients" option first
        $.each(ingredientList, function(index, ingredient) {
            optionsHtml += '<option value="' + ingredient + '">' + ingredient + '</option>';
        });

        // Add the generated options to the filter select element
        $filter.append(optionsHtml);

        $filter.on('change', function() {
            let selectedIngredient = $(this).val();

            $categories.each(function() { // Loop through each category section
                let $category = $(this);
                let $cocktailList = $category.find('.cocktail-list'); // Find the cocktail list within the category

                // Reset the visibility of all cocktails (hide all)
                $cocktailList.find('li.cocktail-item').hide();

                if (selectedIngredient === 'all') {
                    // Show all cocktails if "all" is selected
                    $cocktailList.find('li.cocktail-item').show();
                } else {
                    // Filter cocktails based on selected ingredient (modify to match your data structure)
                    $cocktailList.find('li.cocktail-item').each(function() {
                        let $listItem = $(this);
                        let ingredients = $listItem.find('.coctail-ingredients').text().trim().slice(1, -1).split(', ');
                        if (ingredients.some(function(ingredient) {
                                return ingredient.toLowerCase() === selectedIngredient.toLowerCase();
                            })) {
                            $listItem.show(); // Show matching items
                        }
                    });
                }
            });
        });
    });
})(jQuery);