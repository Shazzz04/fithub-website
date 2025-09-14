<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
    <link rel="stylesheet" href="main.css" />
    <title>Fitchub</title>
  </head>
  <style>
    /* Apply a larger font size to the icon */
        .login-icon .icon-wrapper .material-symbols-outlined {
            font-size: 40px; /* Adjust the size as needed */
            color: #f9ac54;            
        }

.bmi_calculator {
  background-color: #fff7f0;       /* soft cream box */
  border: 2px solid #f9ac54;
  border-radius: 20px;
  padding: 35px 25px;              /* balanced padding */
  width: 100%;
  max-width: 380px;                /* responsive width */
  margin: 60px auto;               /* centers horizontally */
  text-align: center;
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.bmi_header {
  color: #f9ac54;
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 15px;
}

.bmi_text {
  color: #555;
  font-size: 15px;
  line-height: 1.5;
  margin-bottom: 25px;
}

.bmi_input {
  display: flex;
  flex-direction: column;  /* stack inputs neatly */
  gap: 12px;               /* spacing between fields */
  margin-bottom: 20px;
}

.bmi_input input,
.bmi_input select {
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 15px;
  width: 100%;
  box-sizing: border-box;
  outline: none;
  transition: border-color 0.2s;
}

.bmi_input input:focus,
.bmi_input select:focus {
  border-color: #f9ac54;
}

.bmi_btn {
  padding: 14px 30px;
  background-color: #f9ac54;
  border: none;
  border-radius: 12px;
  color: white;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 10px;
  transition: background-color 0.3s, transform 0.2s;
}

.bmi_btn:hover {
  background-color: #e5943f;
  transform: translateY(-2px);
}

.bmi_result {
  margin-top: 25px;
  font-weight: 600;
  font-size: 18px;
  color: #222;
  line-height: 1.4;
  white-space: pre-line; /* preserves line breaks */
}



/* Mobile responsiveness */
@media (max-width: 480px) {
  .bmi_calculator {
    padding: 25px 15px;
    margin: 40px 15px;
  }
  .bmi_header {
    font-size: 22px;
  }
  .bmi_text {
    font-size: 14px;
  }
  .bmi_btn {
    width: 100%;
  }
}

  </style>
  <body>
    <nav>
    <div class="nav__logo">
        <a href="#"><img src="logo.png" alt="logo" /></a>
      </div>
      <ul class="nav__links">
      <li class="link"><a href="main.php">Home</a></li>
      <li class="link"><a href="about.php">About</a></li>
      <li class="link"><a href="class.php">Class</a></li>
      <li class="link"><a href="supplements.php">Supplements</a></li>
      <li class="link"><a href="contact.php">Contact Us</a></li>

      </ul>
      <div class="btn-group">
         <a href="admin.php" class="btn">Login</a>
         <a href="register.php" class="btn">Register</a>
      </div>

      <div class="menu-toggle" id="mobile-menu">
        <i class="ri-menu-line"></i>
      </div>
    </nav>
    <header class="section__container header__container">
      <div class="header__content">
        <span class="bg__blur"></span>
        <span class="bg__blur header__blur"></span>
        <h4>BEST FITNESS IN THE TOWN</h4>
        <h1><span>MAKE</span> YOUR BODY SHAPE</h1>
        <p>
          Unleash your potential and embark on a journey towards a stronger,
          fitter, and more confident you. Sign up for 'Make Your Body Shape' now
          and witness the incredible transformation your body is capable of!
        </p>
        <a href="admin.php">
            <button class="btn">Get Started</button>
        </a>
      </div>
      <div class="header__image">
        <img src="header1.png" alt="header" />
      </div>
    </header>

    <section class="bmi_calculator section_container">
      <h2 class="bmi_header">Check Your BMI🏋️</h2>
      <p class="bmi_text"> Quickly find Out your Body Mass Index and your fitness catergory!</p>

      <div class="bmi_input">
        <label for="unit"> Chose height unit: </label>
        <select id="unit"> 
          <option value="cm" > Centimeters (cm) </option>
          <option value="m"> Meters (m) </option>
      </select>
      <input type="number" id="height" placeholder="Enter your Height"/>
      <input type="number" id="weight" placeholder="Enter your weight (kg)"/>

      </div>

      <button id="calculate" class="btn bmi_btn"> Calculate BMI</button>

      <p id="result" class="bmi_result"></p>
    
      </section>

    <section id="about" class="section__container explore__container">
      <div class="explore__header">
        <h2 class="section__header">EXPLORE OUR PROGRAM</h2>
        <div class="explore__nav">
          <span><i class="ri-arrow-left-line"></i></span>
          <span><i class="ri-arrow-right-line"></i></span>
        </div>
      </div>
      <div class="explore__grid">
        <div class="explore__card">
          <span><i class="ri-boxing-fill"></i></span>
          <h4>Strength</h4>
          <p>
            Embrace the essence of strength as we delve into its various
            dimensions physical, mental, and emotional.
          </p>
          <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-heart-pulse-fill"></i></span>
          <h4>Physical Fitness</h4>
          <p>
            It encompasses a range of activities that improve health, strength,
            flexibility, and overall well-being.
          </p>
          <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-run-line"></i></span>
          <h4>Fat Lose</h4>
          <p>
            Through a combination of workout routines and expert guidance, we'll
            empower you to reach your goals.
          </p>
          <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
        <div class="explore__card">
          <span><i class="ri-shopping-basket-fill"></i></span>
          <h4>Weight Gain</h4>
          <p>
            Designed for individuals, our program offers an effective approach
            to gaining weight in a sustainable manner.
          </p>
          <a href="#">Join Now <i class="ri-arrow-right-line"></i></a>
        </div>
      </div>
    </section>

    <section id="services" class="section__container class__container">
      <div class="class__image">
        <span class="bg__blur"></span>
        <img src="front1.png" alt="class" class="class__img-1" />
        <img src="front3.png" alt="class" class="class__img-2" />
      </div>
      <div class="class__content">
        <h2 class="section__header">THE CLASS YOU WILL GET HERE</h2>
        <p>
          Led by our team of expert and motivational instructors, "The Class You
          Will Get Here" is a high-energy, results-driven session that combines
          a perfect blend of cardio, strength training, and functional
          exercises. Each class is carefully curated to keep you engaged and
          challenged, ensuring you never hit a plateau in your fitness
          endeavors.
        </p>
        <button class="btn">Book A Class</button>
      </div>
    </section>

    <section id="" class="section__container join__container">
      <h2 class="section__header">WHY JOIN US ?</h2>
      <p class="section__subheader">
        Our diverse membership base creates a friendly and supportive
        atmosphere, where you can make friends and stay motivated.
      </p>
      <div class="join__image">
        <img src="join.png" alt="Join" />
        <div class="join__grid">
          <div class="join__card">
            <span><i class="ri-user-star-fill"></i></span>
            <div class="join__card__content">
              <h4>Personal Trainer</h4>
              <p>Unlock your potential with our expert Personal Trainers.</p>
            </div>
          </div>
          <div class="join__card">
            <span><i class="ri-vidicon-fill"></i></span>
            <div class="join__card__content">
              <h4>Practice Sessions</h4>
              <p>Elevate your fitness with practice sessions.</p>
            </div>
          </div>
          <div class="join__card">
            <span><i class="ri-building-line"></i></span>
            <div class="join__card__content">
              <h4>Good Management</h4>
              <p>Supportive management, for your fitness success.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="contact" class="review">
     <div class="section__container review__container">
        <span><i class="ri-double-quotes-r"></i></span>
        <div class="review__content">
          <h4>MEMBER REVIEW</h4>
          <p>
            What truly sets this gym apart is their expert team of trainers. The
            trainers are knowledgeable, approachable, and genuinely invested in
            helping members achieve their fitness goals. They take the time to
            understand individual needs and create personalized workout plans,
            ensuring maximum results and safety.
          </p>
          <div class="review__rating">
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-half-fill"></i></span>
          </div>
          <div class="review__footer">
            <div class="review__member">
              <img src="review.png" alt="member" />
              <div class="review__member__details">
                <h4>Jane Cooper</h4>
                <p>Software Developer</p>
              </div>
            </div>
            <div class="review__nav">
              <span><i class="ri-arrow-left-line"></i></span>
              <span><i class="ri-arrow-right-line"></i></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="section__container footer__container">
      <span class="bg__blur"></span>
      <span class="bg__blur footer__blur"></span>
      <div class="footer__col">
        <div class="footer__logo"><img src="logo.png" alt="logo" /></div>
        <p>
          Take the first step towards a healthier, stronger you with our
          unbeatable pricing plans. Let's sweat, achieve, and conquer together!
        </p>
        <div class="footer__socials">
          <a href="#"><i class="ri-facebook-fill"></i></a>
          <a href="#"><i class="ri-instagram-line"></i></a>
          <a href="#"><i class="ri-twitter-fill"></i></a>
        </div>
      </div>
      <div class="footer__col">
        <h4>Company</h4>
        <a href="#">Business</a>
        <a href="#">Franchise</a>
        <a href="#">Partnership</a>
        <a href="#">Network</a>
      </div>
      <div class="footer__col">
        <h4>About Us</h4>
        <a href="#">Blogs</a>
        <a href="#">Security</a>
        <a href="#">Careers</a>
      </div>
      <div class="footer__col">
        <h4>Contact</h4>
        <a href="#">Contact Us</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">BMI Calculator</a>
      </div>
    </footer>
    <div class="footer__bar">
      Copyright © 2025 FitHub. All rights reserved.
    </div>

    <script>
      const mobileMenu = document.getElementById('mobile-menu');
      const navLinks = document.querySelector('.nav__links');

      mobileMenu.addEventListener('click', () => {
        navLinks.classList.toggle('active');
      });
    </script>

    <script>
// 👉 First we say: "When the button with id='calculate' is clicked, run this function"
document.getElementById('calculate').addEventListener('click', () => {

  // 👉 Grab the selected unit (cm or m) from the dropdown/input with id="unit"
  const unit = document.getElementById('unit').value;

  // 👉 Grab the height the user typed, convert from text to number
  let height = parseFloat(document.getElementById('height').value);

  // 👉 Grab the weight the user typed, also as a number
  const weight = parseFloat(document.getElementById('weight').value);

  // 👉 If the user forgot to enter height or weight, show a pop-up and stop here
  if (!height || !weight) {
    alert("Please enter both height and weight!");
    return; // stop running the rest of the code
  }

  // 👉 If the chosen unit is 'cm', convert it to meters (because BMI uses meters)
  if (unit === 'cm') height = height / 100;

  // 👉 Calculate BMI with the formula: weight ÷ (height squared)
  const bmi = weight / (height ** 2);

  // 👉 Decide which category the BMI belongs to
  let category = '';
  if (bmi < 18.5) category = "Underweight 🥲";
  else if (bmi < 25) category = "Normal weight 😎";
  else if (bmi < 30) category = "Overweight 😅";
  else category = "Obese 😮";

  // 👉 Show the result on the page inside the element with id="result"
  // bmi.toFixed(2) means we only keep 2 decimal places (like 22.45)
  document.getElementById('result').innerText =
    `Your BMI is: ${bmi.toFixed(2)}\nCategory: ${category}`;
});
</script>

  </body>
</html>

