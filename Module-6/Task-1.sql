SELECT  c.customer_id,c.name, c.email, c.location,COUNT(o.order_id) as total_orders
FROM  Customers c
LEFT JOIN Orders o ON c.customer_id = o.customer_id
GROUP BY  c.customer_id, c.name, c.email, c.location
ORDER BY total_orders DESC;
