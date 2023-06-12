<!DOCTYPE html>

<html lang="en" class="AboutPage">
<head>
    <meta charset="utf-8">
    <meta name="description" content="A page about our group and group project">
    <meta name="keywords" content="HTML5, About, Group">
    <meta name="author" content="Josh Celestino">
    <title>About Us</title>
    <link href="styles/style.css" rel="stylesheet">
</head>

<body>
<header>
    <article class="navbar">
        <?php include 'nav.inc'; ?>
    </article>
    <section class="top">
        <h1 id="AboutUs">About Us</h1>
        <h2>Our Team: <span id="teamName">The Boys & Co.</span></h2>
        <p id="description">We are a team of 5 that is creating <span id="innovative">innovative</span> websites for our unit
            COS-10026<br><br>
            Here at The Boys & Co, we make compelling, innovative and seamless websites <br>and we attempt to stand
            apart from the competitors<br><br>Additionally, we are a growing tech company with facilities in 4 countries.
            We offer a range of IT services, <br>
            from Database management to front-end development.<br><br>
            <form action="#meetTheTeam" method="get">
                <button class="button3">Meet The Team</button>
            </form>
    </section>
</header>

<article class="InfoContainer">
    <h2 id="meetTheTeam">Meet The Team</h2>
    <section class="TopBar">
        <dl>
            <dt><strong>Name:</strong><br>The Boys & Co</dt>
            <dd><strong>GroupId:</strong><br>104550240</dd>
            <dt><strong>Tutor:</strong><br>Md Kafil Uddin</dt>
            <dd><strong>Course: </strong><br>Computer Science</dd>
        </dl>
        <figure class="GroupPhoto">
            <img src="images/GroupPhoto.png" alt="Our Group Photo">
        </figure>
    </section>
    <br>

    <div class="GroupList">
        <strong>Our group was formed 27th of Feb 2023 consisting of:</strong><br>
        Josh Celestino <br>
        Vikrant Tiwari <br>
        Marcus Green <br>
        Michael Gebrekidan <br>
        Manh Hung Pham <br><br><br><br><br>
    </div>
    <div class="GroupDesc">
        <h2>A Little About Us</h2>
        <br>
        We are as a team help each other out while making innovative websites using HTML and CSS <br><br>
        A common favorite hobby among us is Coding and learning to further our coding skills; we all <br>
        love to joke around. However, like many other people, we have different hobbies in life. <br><br>
        Josh's Favorite hobby is spending time in the gym to gain muscles and also loves to code and study <br><br>
        Marcus' Favorite Hobby is spending time in the gym, Marcus is also very studious about his studies and is
        very disciplined <br><br>
        Vikrant's Favorite Hobby is working at his part-time job, coding and studying for his Units in his spare
        time <br><br>
        Michael's Favorite Hobby is spending time outside and appreciating nature and its beauty while also coding
        <br><br>
        Kyle's Favorite Hobby is soccer, Kyle loves soccer and spending time with his loved ones while striving for
        success <br><br>
    </div>

    <table id="Timetable">
        <caption id="TableCapt">Timetable Details</caption>
        <thead>
        <tr>
            <th rowspan="2" scope="col">Time</th>
            <th colspan="5" scope="col">Day</th>
        </tr>
        <tr>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">8:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">9:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">10:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">11:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">NOON</th>
            <td rowspan="2">Online Lecture</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">1:00</th>
            <td></td>
            <td rowspan="2">Class Tutorial</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">2:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">3:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">4:00</th>
            <td rowspan="2">Workshop Class</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th scope="row">5:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th scope="row">6:00</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
</article>

<?php include 'footer.inc'; ?>

</body>
</html>
