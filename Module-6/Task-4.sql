SELECT c.name AS customer_name, SUM(o.total_amount) AS total_purchase_amount
FROM Customers c
JOIN  Orders o ON c.customer_id = o.customer_id
GROUP BY c.name
ORDER BY  total_purchase_amount DESC
LIMIT 5;
