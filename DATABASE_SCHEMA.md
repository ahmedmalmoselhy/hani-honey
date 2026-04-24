# Database Schema - Hani Honey

This document outlines the database schema for the Hani Honey management system.

## Entities

### 1. Users

Manages administrative access to the system.

- `id`: Primary Key
- `name`: String
- `email`: String (Unique)
- `password`: String
- `remember_token`: String
- `timestamps`

### 2. Customers

Stores information about regular and bulk customers.

- `id`: Primary Key
- `name`: String
- `phone`: String (Nullable)
- `email`: String (Nullable)
- `address`: Text (Nullable)
- `timestamps`

### 3. Patches

Tracks honey production batches (2 patches per year).

- `id`: Primary Key
- `year`: Integer (e.g., 2024)
- `patch_number`: Integer (1 or 2)
- `total_weight`: Decimal(10, 2) (Total net weight produced)
- `remaining_weight`: Decimal(10, 2) (Current weight available in storage)
- `current_price_per_kg`: Decimal(10, 2)
- `status`: Enum ('active', 'depleted')
- `notes`: Text (Nullable)
- `timestamps`

### 4. Price History

Tracks price changes for each patch over time.

- `id`: Primary Key
- `patch_id`: Foreign Key (patches)
- `price_per_kg`: Decimal(10, 2)
- `changed_at`: Timestamp
- `notes`: String (Nullable)

### 5. Sales

Records individual sales transactions.

- `id`: Primary Key
- `patch_id`: Foreign Key (patches)
- `customer_id`: Foreign Key (customers, Nullable for anonymous walk-ins)
- `weight`: Decimal(10, 2)
- `unit_price`: Decimal(10, 2) (Price at the time of sale)
- `total_price`: Decimal(10, 2)
- `sold_at`: Timestamp
- `notes`: Text (Nullable)
- `timestamps`

### 6. Bulk Orders

Handles pre-paid bulk orders where honey is stored by the seller.

- `id`: Primary Key
- `customer_id`: Foreign Key (customers)
- `patch_id`: Foreign Key (patches)
- `total_weight`: Decimal(10, 2)
- `total_price`: Decimal(10, 2)
- `amount_paid`: Decimal(10, 2)
- `remaining_weight`: Decimal(10, 2) (Weight yet to be collected)
- `status`: Enum ('pending', 'paid', 'completed', 'cancelled')
- `ordered_at`: Timestamp
- `timestamps`

### 7. Bulk Order Withdrawals

Tracks chunks of honey taken from a bulk order.

- `id`: Primary Key
- `bulk_order_id`: Foreign Key (bulk_orders)
- `weight`: Decimal(10, 2)
- `withdrawn_at`: Timestamp
- `notes`: Text (Nullable)
- `timestamps`

### 8. Internal Usage (Gifts & Home Usage)

Tracks non-sale deductions from patches.

- `id`: Primary Key
- `patch_id`: Foreign Key (patches)
- `weight`: Decimal(10, 2)
- `type`: Enum ('gift', 'home_usage', 'loss')
- `recipient`: String (Nullable, for gifts)
- `notes`: Text (Nullable)
- `occurred_at`: Timestamp
- `timestamps`

---

## Key Business Logic Notes

1. **Inventory Management**:
   - When a **Sale** or **Internal Usage** record is created, the `patch.remaining_weight` is deducted.
   - When a **Bulk Order** is created, the `patch.remaining_weight` is deducted immediately (reserving the honey), and the `bulk_order.remaining_weight` is set to the total weight.
   - **Bulk Order Withdrawals** deduct from `bulk_order.remaining_weight` but do NOT affect `patch.remaining_weight` (as it was already deducted).

2. **Pricing**:
   - `patches.current_price_per_kg` is the latest price.
   - `sales.unit_price` captures the historical price at the moment of transaction.
   - `price_history` allows auditing price fluctuations for a specific patch.

3. **Authentication**:
   - Access is restricted to authenticated users (admin-only). No public storefront or customer registration.
