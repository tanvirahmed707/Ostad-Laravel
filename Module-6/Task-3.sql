SELECT c.name AS category_name, SUM(oi.quantity * oi.unit_price) AS total_revenue
FROM  Categories c
JOIN Products p ON c.category_id = p.category_id
JOIN Order_Items oi ON p.product_id = oi.product_id
GROUP BY c.name
ORDER BY total_revenue DESC;
