<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "verka";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate user credentials
function authenticateUser($email, $password, $conn) {
    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();
    
    // If user exists, return true; otherwise, false
    if ($stmt->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate email and password
    if (!empty($email) && !empty($password)) {
        $hashed_password = md5($password); // You should use stronger password hashing techniques in production

        // Authenticate user
        if (authenticateUser($email, $hashed_password, $conn)) {
            // Authentication successful, set session variables
            $_SESSION["email"] = $email;
            header("Location: index.php"); // Redirect to secure page after login
            exit;
        } else {
            // Authentication failed, display error message
            $error = "Invalid email or password.";
        }
    } else {
        // Fields are empty, display error message
        $error = "Please enter email and password.";
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verka Project</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo"> <i class="fas fa-shopping-basket"></i>Verka </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#features">features</a>
        <a href="#products">products</a>
        <a href="#categories">categories</a>
        <a href="#review">review</a>
        <a href="#blogs">blogs</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-user" id="login-btn"></div>
    </div>

    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </form>

    <div class="shopping-cart">
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-1.png" alt="">
            <div class="content">
                <h3>watermelon</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-2.png" alt="">
            <div class="content">
                <h3>onion</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="box">
            <i class="fas fa-trash"></i>
            <img src="image/cart-img-3.png" alt="">
            <div class="content">
                <h3>chicken</h3>
                <span class="price">$4.99/-</span>
                <span class="quantity">qty : 1</span>
            </div>
        </div>
        <div class="total"> total : $19.69/- </div>
        <a href="#" class="btn">checkout</a>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
        <h3>Login Now</h3>
        <input type="email" name="email" placeholder="Your Email" class="box" required>
        <input type="password" name="password" placeholder="Your Password" class="box" required>
        <p>Forgot your password? <a href="#">Click here</a></p>
        <p>Don't have an account? <a href="#">Create now</a></p>
        <input type="submit" value="Login Now" class="btn">
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </form>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">
    <div class="content">
        <h3>Verka  <span>Branch</span>Sales offices</h3>
       
       
    </div>

</section>

<!-- home section ends -->

<!-- features section starts  -->

<section class="features" id="features">

    <h1 class="heading"> our <span>features</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="image/milk-products-vector-21403755-removebg-preview.png" alt="">
            <h3>fresh and organic</h3>
            <p>Fresh vegetables and fruits in cheap price.</p>
          
        </div>

        <div class="box">
            <img src="image/feature-img-2.png" alt="">
            <h3>free delivery</h3>
            <p>We always do fast delivery on our customers.</p>
           
        </div>

        <div class="box">
            <img src="image/feature-img-3.png" alt="">
            <h3>easy payments</h3>
            <p>It is very easy to pay on our website, you can pay easily.</p>
            
        </div>

    </div>

</section>

<!-- features section ends -->

<!-- products section starts  -->

<section class="products" id="products">

    <h1 class="heading"> our <span>products</span> </h1>

    <div class="swiper product-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <a href="milk .html"><img src="image/milk pouch.webp" alt="">
                <h3>fresh milk</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a></a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka dahi.jpg" alt="">
                <h3>fresh Dahi</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka lasssi.jpg" alt="">
                <h3>fresh Lassi</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka sweets.jpeg" alt="">
                <h3>fresh Sweets</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

        </div>

    </div>

    <div class="swiper product-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <img src="image/verka ice cream.jpeg" alt="">
                <h3>fresh Ice cream</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka kheer.webp" alt="">
                <h3>fresh kheer</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka cream.jpg" alt="">
                <h3>fresh cream</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

            <div class="swiper-slide box">
                <img src="image/verka chesse.png" alt="">
                <h3>fresh Cheese</h3>
                <div class="price"> $4.99/- - 10.99/- </div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <a href="#" class="btn">add to cart</a>
                <a href="loginpage.php" class="btn">Buy now</a>
            </div>

        </div>

    </div>


</section>

<!-- products section ends -->

<!-- categories section starts  -->

<section class="categories" id="categories">

    <h1 class="heading"> product <span>categories</span> </h1>

    <div class="box-container">

        <div class="box">
            <a href="milk .html">
            <img src="image/milk pouch.webp" alt="">
            <h3>Milk</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>

        <div class="box">
            <a href="Freshproduct.html">
            <img src="image/yogrut.jpeg" alt="">
            <h3>fresh Product</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>

        <div class="box">
            <a href="beeverages.html">
            <img src="image/berages '.png" alt="">
            <h3>Beverages</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>

        <div class="box">
            <a href="freshicecream.html">
            <img src="image/ice cream.webp" alt="">
            <h3>fresh Ice cream</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>

        <div class="box">
            <a href="sweets.html">
            <img src="image/sweets.jpg" alt="">
            <h3>Sweets</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>

        <div class="box">
            <a href="cattlefeed.html">
            <img src="image/cattlefeed'.jpg" alt="">
            <h3>Cattlefeed</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>
        <div class="box">
            <a href="gheebuttercream.html">
            <img src="image/ghee-butter.png" alt="">
            <h3>Ghee,butter, cream</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>
        <div class="box">
            <a href="cheesespred.html">
            <img src="image/chesse spread.png" alt="">
            <h3>Cheese and spread</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>
        <div class="box">
            <a href="milkpowder.html">
            <img src="image/milk powder.jpg" alt="">
            <h3>Milk powder</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>
        <div class="box">
            <a href="uhtmilk.html">
            <img src="image/milk categoired.png" alt="">
            <h3>UHT milk</h3>
            <p>upto 45% off</p>
            <a href="#" class="btn">shop now</a></a>
        </div>


    </div>

</section>

<!-- categories section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> customer's <span>review</span> </h1>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <img src="image/pic-1.png" alt="">
                <p>Very good website. All the stuff on this website is absolutely great. You all can buy your stuff from here.</p>
                <h3>john</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="image/pic-2.png" alt="">
                <p>Very good website. All the stuff on this website is absolutely great. You all can buy your stuff from here.</p>
                <h3>Juliyana</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="image/pic-3.png" alt="">
                <p>Very good website. All the stuff on this website is absolutely great. You all can buy your stuff from here.</p>
                <h3>Jonathon</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="image/pic-4.png" alt="">
                <p>Very good website. All the stuff on this website is absolutely great. You all can buy your stuff from here.</p>
                <h3>Oliveya</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

        </div>

    </div>

</section>

<!-- review section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> our <span>blogs</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="image/blog 1.jpeg" alt="">
            <div class="content">
                <div class="icons">
                    <a href="#"> <i class="fas fa-user"></i> by user </a>
                    <a href="#"> <i class="fas fa-calendar"></i> 1st oct, 2021 </a>
                </div>
                <h3>fresh and organic vegitables and fruits</h3>
                <p>Organica Is Where Early Adopters And Innovation Sockers Find Lively, Imaginative Tech Before It Hits The Mainstream.</p>
                
            </div>
        </div>

        <div class="box">
            <img src="image/blog2.jpg" alt="">
            <div class="content">
                <div class="icons">
                    <a href="#"> <i class="fas fa-user"></i> by user </a>
                    <a href="#"> <i class="fas fa-calendar"></i> 1st oct, 2021 </a>
                </div>
                <h3>fresh and organic vegitables and fruits</h3>
                <p>Organica Is Where Early Adopters And Innovation Sockers Find Lively, Imaginative Tech Before It Hits The Mainstream.</p>
               
            </div>
        </div>

        <div class="box">
            <img src="image/blog3.jpeg" alt="">
            <div class="content">
                <div class="icons">
                    <a href="#"> <i class="fas fa-user"></i> by user </a>
                    <a href="#"> <i class="fas fa-calendar"></i> 1st oct, 2021 </a>
                </div>
                <h3>fresh and organic vegitables and fruits</h3>
                <p>Organica Is Where Early Adopters And Innovation Sockers Find Lively, Imaginative Tech Before It Hits The Mainstream.</p>
              
            </div>
        </div>

    </div>

</section>

<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3> Verka <i class="fas fa-shopping-basket"></i> </h3>
            <p>Hello my name is Rishi Kumar. I made this website for sell a milk product with collab a verka agency.</p>
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="https://www.instagram.com/_hey_im_rishi/" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +91 8437212821</a>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +91 9140026484 </a>
            <a href="#" class="links"> <i class="fas fa-envelope"></i>verkaagency1267@gmail.com </a>
            <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i>shimlapuri,new ludhiana  </a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#" class="links"> <i class="fas fa-arrow-right"></i> home </a>
            <a href="#" class="links"> <i class="fas fa-arrow-right"></i> features </a>
            <a href="#" class="links"> <i class="fas fa-arrow-right"></i> products </a>
            <a href="#" class="links"> <i class="fas fa-arrow-right"></i> categories </a>
        </div>

        <div class="box">
            <h3>newsletter</h3>
            <p>subscribe for latest updates</p>
            <input type="email" placeholder="your email" class="email">
            <input type="submit" value="subscribe" class="btn">
            <img src="image/payment.png" class="payment-img" alt="">
        </div>

    </div>

    <div class="credit">created by <span> Rishi </span> | all rights reserved </div>

</section>

<!-- footer section ends -->

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>