
SELECT 
    c.customer_id as CustomerID
    c.name as CustomerName,
    c.email as CustomerEmail,
    c.location as CustomerLocation,
    COUNT(o.order_id) as TotalOrders
FROM  Customers c
LEFT JOIN Orders o ON c.customer_id = o.customer_id
GROUP BY  c.customer_id
ORDER BY TotalOrders DESC;
