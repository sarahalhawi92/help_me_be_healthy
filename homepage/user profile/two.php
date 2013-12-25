<?php

SELECT 
  Product.ProductID,
  Location.Country,
  Resource.ResourceName AS Manufacturer,
  BrandResource.ResourceName AS Brand,
  Product.Name,
  Product.UPC,
  Product.Size,
  Unit.Abbreviation AS Measure,
  Category.ParentID AS Category,
  Category.Description AS Sub_Category,
  Ingredient.Description AS Ingredients,
  Ingredient.MayContain AS Allergen_Statement,
  (SELECT GROUP_CONCAT( Special.Description SEPARATOR ', ' ) AS Free_From
    FROM Product
    LEFT JOIN ProductSpecial 
      ON Product.ProductID = ProductSpecial.ProductID
    LEFT JOIN Special 
      ON ProductSpecial.SpecialID = Special.SpecialID
    GROUP BY Product.ProductID
    )
FROM Product
  INNER JOIN ProductStatus ON ... however it's joined
  LEFT JOIN ProductCountry ON Product.ProductID = ProductCountry.ProductID
  LEFT JOIN Location ON ProductCountry.LocationID = Location.LocationID
  LEFT JOIN Resource ON Product.ManufactureCode = Resource.ResourceID
  LEFT JOIN Resource BrandResource ON Product.BrandCode = BrandResource.ResourceID
  LEFT JOIN Unit ON Product.Unit = Unit.UnitID
  LEFT JOIN ProductCategory ON Product.ProductID = ProductCategory.ProductID
  LEFT JOIN Category ON ProductCategory.CategoryID = Category.CategoryID
  LEFT JOIN Ingredient ON Product.ProductID = i.IngredientID
WHERE ProductStatus.ProductStatusID = 1

?>