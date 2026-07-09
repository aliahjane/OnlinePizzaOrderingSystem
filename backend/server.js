const express = require("express");
const mysql = require("mysql");
const cors = require("cors");
const md5 = require("md5");
const path = require("path");

const app = express();

// =======================
// MIDDLEWARE
// =======================
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// =======================
// STATIC PRODUCT IMAGE FOLDER
// =======================
app.use(
  "/assets/img",
  express.static(
    path.join(__dirname, "assets", "img")
  )
);

// =======================
// DATABASE CONNECTION
// =======================
const db = mysql.createConnection({
  host: "127.0.0.1",
  port: 3306,
  user: "root",
  password: "",
  database: "opos_db",
});

// =======================
// CONNECT DATABASE
// =======================
db.connect((err) => {
  if (err) {
    console.log("Database Connection Error:", err.message);
  } else {
    console.log("Connected to OPOS Database Successfully!");
  }
});

// =======================
// ROOT ROUTE
// =======================
app.get("/", (req, res) => {
  res.send("PizzaHut API Server Running Successfully");
});

// =======================
// GET ALL USERS
// =======================
app.get("/users", (req, res) => {

  const sql = `
    SELECT
      id,
      name,
      username,
      type
    FROM users
    ORDER BY name ASC
  `;

  db.query(sql, (err, result) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    res.json({
      success: true,
      users: result
    });

  });

});

// =======================
// GET ALL MOBILE APP USERS
// =======================
app.get("/user_info", (req, res) => {

    const sql = `
        SELECT
            user_id,
            first_name,
            last_name,
            email,
            mobile,
            address
        FROM user_info
        ORDER BY user_id DESC
    `;

    db.query(sql, (err, rows) => {

        if (err) {
            return res.status(500).json({
                success: false,
                error: err.message
            });
        }

        res.json({
            success: true,
            users: rows
        });

    });

});

// =======================
// USER REGISTRATION
// =======================
app.post("/register", (req, res) => {
    const {
        first_name,
        last_name,
        email,
        password,
        mobile,
        address
    } = req.body;

    if (
        !first_name ||
        !last_name ||
        !email ||
        !password ||
        !mobile ||
        !address
    ) {
        return res.status(400).json({
            success: false,
            message: "All fields are required"
        });
    }

    const checkSql =
        "SELECT user_id FROM user_info WHERE email=?";

    db.query(checkSql, [email], (err, rows) => {

        if (err) {
            return res.status(500).json({
                success: false,
                error: err.message
            });
        }

        if (rows.length > 0) {
            return res.json({
                success: false,
                message: "Email already exists"
            });
        }

        const sql = `
            INSERT INTO user_info
            (
                first_name,
                last_name,
                email,
                password,
                mobile,
                address
            )
            VALUES (?, ?, ?, ?, ?, ?)
        `;

        db.query(
            sql,
            [
                first_name,
                last_name,
                email,
                md5(password),
                mobile,
                address
            ],
            (err, result) => {

               if (err) {
                      console.log("REGISTER ERROR:");
                      console.log(err);

                      return res.status(500).json({
                          success:false,
                          error: err.message
                      });
                  }
                res.json({
                    success: true,
                    message: "Success",
                    user_id: result.insertId
                });
            }
        );
    });
});

// =======================
// USER LOGIN
// =======================
app.post("/login", (req, res) => {
    const { email, password } = req.body;
    if (!email || !password) {
        return res.status(400).json({
            success: false,
            message: "Email and password are required"
        });
    }
    const sql =
        "SELECT * FROM user_info WHERE email=?";
    db.query(sql, [email], (err, rows) => {
        if (err) {
            return res.status(500).json({
                success: false,
                error: err.message
            });
        }
        if (rows.length == 0) {
            return res.json({
                success: false,
                message: "User not found"
            });
        }
        const user = rows[0];
        if (user.password != md5(password)) {
            return res.json({
                success: false,
                message: "Invalid password"
            });
        }
        res.json({
            success: true,
            message: "Login successful",
            user: user
        });
    });
});

// =======================
// GET ALL CATEGORIES
// =======================
app.get("/categories", (req, res) => {

  const sql = `
    SELECT
      id,
      name
    FROM category_list
    ORDER BY name ASC
  `;

  db.query(sql, (err, result) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    res.json({
      success: true,
      categories: result
    });

  });

});

// =======================
// GET ALL PRODUCTS
// =======================
app.get("/products", (req, res) => {

  const sql = `
    SELECT
      p.id,
      p.name,
      p.description,
      p.price,
      p.img_path,
      p.category_id,
      p.status,
      c.name AS category

    FROM product_list p

    LEFT JOIN category_list c
    ON p.category_id = c.id

    WHERE p.status = 1

    ORDER BY p.name ASC
  `;

  db.query(sql, (err, result) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    const products = result.map((item) => ({

      id: item.id,
      name: item.name,
      description: item.description,
      price: item.price,
      category_id: item.category_id,
      category: item.category,
      img_path: item.img_path,

      image_url:
        `http://192.168.1.55:3001/assets/img/${item.img_path}`

    }));

    res.json({
      success: true,
      products
    });

  });

});

// =======================
// GET PRODUCTS BY CATEGORY
// =======================
app.get("/products/category/:id", (req, res) => {

  const categoryId = req.params.id;

  const sql = `
    SELECT
      p.id,
      p.name,
      p.description,
      p.price,
      p.img_path,
      p.category_id,
      c.name AS category

    FROM product_list p

    LEFT JOIN category_list c
    ON p.category_id = c.id

    WHERE p.category_id = ?
    AND p.status = 1

    ORDER BY p.name ASC
  `;

  db.query(sql, [categoryId], (err, result) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    const products = result.map((item) => ({

      id: item.id,
      name: item.name,
      description: item.description,
      price: item.price,
      category_id: item.category_id,
      category: item.category,
      img_path: item.img_path,

      image_url:
        `http://192.168.1.55:3001/assets/img/${item.img_path}`

    }));

    res.json({
      success: true,
      products
    });

  });

});

// =======================
// PLACE ORDER
// =======================
app.post("/place-order", (req, res) => {

  const {
    name,
    address,
    mobile,
    email,
    cart
  } = req.body;

  if (!name || !address || !mobile || !email) {
    return res.status(400).json({
      success: false,
      message: "All customer fields are required"
    });
  }

  const orderSql = `
    INSERT INTO orders
    (
      name,
      address,
      mobile,
      email,
      status
    )
    VALUES (?, ?, ?, ?, 0)
  `;

  db.query(
    orderSql,
    [
      name,
      address,
      mobile,
      email
    ],
    (err, result) => {

      if (err) {
        return res.status(500).json({
          success: false,
          error: err.message
        });
      }

      const orderId = result.insertId;

      if (!cart || cart.length === 0) {
        return res.json({
          success: true,
          message: "Order placed successfully",
          order_id: orderId
        });
      }

      let completed = 0;

      cart.forEach((item) => {

        const detailSql = `
          INSERT INTO order_list
          (
            order_id,
            product_id,
            qty
          )
          VALUES (?, ?, ?)
        `;

        db.query(
          detailSql,
          [
            orderId,
            item.product_id,
            item.qty
          ],
          (detailErr) => {

            if (detailErr) {
              return res.status(500).json({
                success: false,
                error: detailErr.message
              });
            }

            completed++;

            if (completed === cart.length) {

              res.json({
                success: true,
                message: "Order placed successfully",
                order_id: orderId
              });

            }

          }
        );

      });

    }
  );

});

// =======================
// GET ALL ORDERS
// =======================
app.get("/orders", (req, res) => {

  const sql = `
    SELECT
      o.id,
      o.name,
      o.address,
      o.mobile,
      o.email,
      o.status,

      ol.qty,

      p.name AS product_name,
      p.price

    FROM orders o

    LEFT JOIN order_list ol
    ON o.id = ol.order_id

    LEFT JOIN product_list p
    ON ol.product_id = p.id

    ORDER BY o.id DESC
  `;

  db.query(sql, (err, result) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    res.json({
      success: true,
      orders: result
    });

  });

});

// =======================
// UPDATE ORDER STATUS
// =======================
app.put("/orders/status/:id", (req, res) => {

  const orderId = req.params.id;
  const { status } = req.body;

  const sql = `
    UPDATE orders
    SET status = ?
    WHERE id = ?
  `;

  db.query(sql, [status, orderId], (err) => {

    if (err) {
      return res.status(500).json({
        success: false,
        error: err.message
      });
    }

    res.json({
      success: true,
      message: "Order status updated successfully"
    });

  });

});


// =======================
// SERVER CHECK
// =======================
app.get("/health", (req, res) => {
  res.json({
    success: true,
    message: "API running"
  });
});

// =======================
// START SERVER
// =======================
const PORT = 3001;

app.listen(PORT, "0.0.0.0", () => {
  console.log(`PizzaHut API running on port ${PORT}`);
});