<?php session_start(); ?>

<style>
  <?php include 'Navbar.css'; ?>
</style>

<div class="page">
  <nav class="page__menu menu">
    <ul class="menu__list r-list">
      <li class="menu__group"><a href="/WebProgramiranje/index.php" class="menu__link r-link text-underlined">Home</a></li>

      <?php

      if (isset($_SESSION["UserName"]) == true) {

        if ($_SESSION["tip"] == "admin") {
          echo "<li class='menu__group'><a href='Raspored.php' class='menu__link r-link text-underlined'>Dashboard</a></li>";
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/User/ApproveTeacher.php' class='menu__link r-link text-underlined'>Zahtevi</a></li>";
        }
        if($_SESSION["tip"]=="predavac"){
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/Courses/CreateCourses/MyCourses.php' class='menu__link r-link text-underlined'>My Courses</a></li>";
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/Courses/OnCourse.php' class='menu__link r-link text-underlined'>My Courses</a></li>";
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/Courses/CreateCourses/CreateCourse.php' class='menu__link r-link text-underlined'>Create Course</a></li>";

        }
        if($_SESSION["tip"]=="korisnik"){
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/Courses/CreateCourses/Learning.php' class='menu__link r-link text-underlined'>Learning</a></li>";
          echo "<li class='menu__group'><a href='/WebProgramiranje/Pages/User/History.php' class='menu__link r-link text-underlined'>History</a></li>";
        }
        echo ' <li class="menu__group"><a href="/WebProgramiranje/Pages/Courses/Course.php" class="menu__link r-link text-underlined">Courses</a></li>';
        echo "<li class='menu__group'><a href='/WebProgramiranje/Components/Navbar/Logout.php' class='menu__link r-link text-underlined'>Sign-Out</a></li>";
        
      } else
        echo "<li class='menu__group'><a href='/WebProgramiranje/./Components/Registration/Register.php' class='menu__link r-link text-underlined'>Register/Sign In</a></li>";
      ?>
    </ul>
  </nav>
</div>