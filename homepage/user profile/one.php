>?php

SELECT 
  Product.ProductID,
  (
  SELECT Abbreviation AS Country
  FROM Product
  LEFT JOIN ProductCountry 
    ON Product.ProductID = ProductCountry.ProductID
  LEFT JOIN Location 
    ON ProductCountry.LocationID = Location.LocationID
  GROUP BY Product.ProductID
  ),

  (
  SELECT r.ResourceName AS Manufacturer, rr.ResourceName AS Brand
  FROM Product p
  LEFT JOIN Resource r 
    ON p.ManufactureCode = r.ResourceID
  INNER JOIN Resource rr 
    ON p.BrandCode = rr.ResourceID
  ),

  Product.Name,
  Product.UPC,
  Product.Size,

  (
  SELECT Unit.abbreviation AS Measure
  FROM Product
  LEFT JOIN Unit 
    ON Product.Unit = Unit.UnitID
  ),

  (
  SELECT Category.ParentID AS Category, Category.Description AS Sub_Category
  FROM Product
  LEFT JOIN ProductCategory 
    ON Product.ProductID = ProductCategory.ProductID
  LEFT JOIN Category 
    ON ProductCategory.CategoryID = Category.CategoryID
  ),

  (
  SELECT i.Description AS INGREDIENTS, i.MayContain AS Allergen_Statement
  FROM Product
  LEFT JOIN Ingredient i 
    ON Product.ProductID = i.IngredientID
  ),

  (
  SELECT GROUP_CONCAT( Special.Description SEPARATOR ', ' ) AS Free_From
  FROM Product
  LEFT JOIN ProductSpecial 
    ON Product.ProductID = ProductSpecial.ProductID
  LEFT JOIN Special 
    ON ProductSpecial.SpecialID = Special.SpecialID
  GROUP BY Product.ProductID
  )

FROM Product, ProductStatus
WHERE ProductStatus.ProductStatusID = 1

?>