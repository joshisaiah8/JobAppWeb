<!DOCTYPE html>
<html lang="en" class="EnhancePage">
<head>
    <meta charset="utf-8">
    <meta name="description" content="A page about our group and group project">
    <meta name="keywords" content="HTML5, About, Group">
    <meta name="author" content="Josh Celestino">
    <title>Enhancements</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <section class="navbar" id="NavJumpTo">
            <?php include 'nav.inc'; ?>
        </section>
    </header>

    <section>
        <aside class="EnhanceTitle">
            <h1>Enhancements in our Website</h1>
            <form action="#Example1" method="get">
                <button class="EnhanceButton">Show Me!</button>
            </form>
        </aside>
        <article class="EnhanceOne" id="Example1">
            <h3>Responsive Web Design</h3>
            <figure>
                <img src="images/Responsive-Web-Design.gif" alt="Responsive Web Design video" class="EnhancePageimg">
                <figcaption>Abouts Page by Josh Celestino</figcaption>
            </figure>
            <p>Responsive Web Design is the most vital Enhancement<br>
                'The Boys & Co' have added to the website as it enhances<br>
                the user's experience in our website.<br><br>
                This goes above and beyond as going through each page and always using<br>
                relative units is a meticulous process which was not taught thoroughly to us during the lectures,<br>
                and the use of calc to calculate the font size was also not taught to us<br><br>
                The code we used for this was using relative units such as<br>
                vm, em, vh, and % instead of fixed units such as px and this:<br>
                <code>
                html {
                    font-size: calc(0.7vh + 0.7vw);
                }
                </code>
            </p>
            <form action="about.html" method="get">
                <button class="button3">Example</button>
            </form>
        </article>

        <article class="EnhanceTwo" id="Example2">
            <h3>Parallax Effect</h3>
            <figure>
                <img src="images/Parallax-Effect.gif" alt="Parallax Effect video" class="EnhancePageimg">
                <figcaption>Home Page by Marcus green</figcaption>
            </figure>
            <p>Parallax effect refers to a technique<br>
                where the background images move at a different speed than the<br>
                foreground content, creating an illusion of depth and a 3D-like effect.<br><br>
                This goes above and beyond what we were taught as the use of scrolling the foreground instead of<br>
                scrolling both the foreground and the background was not a concept which was taught during the lectures<br><br>
                We used code such as this to achieve the effect:<br>
                <code>
                background: url(../images/DataBaseBck.jpg) no-repeat center center fixed;<br>
                background-size: cover;
                </code>
            </p>
            <form action="index.html" method="get">
                <button class="button3">Example</button>
            </form>
        </article>

        <article class="EnhanceThree" id="Example3">
            <h3>Element Transitions</h3>
            <figure>
                <img src="images/Transition.gif" alt="Transitions Effect video" class="EnhancePageimg">
                <figcaption>Home Page by Marcus green</figcaption>
            </figure>
            <p>A Load-in transition effect was placed on our website to give the user<br> 
                a more fluid experience when traversing our website.<br><br>
                This goes above and beyond as it utilizes @keyframes, which is a concept completely<br>
                foreign as it was not taught during lectures and needed self-research to achieve.<br><br>
                This is the code used for the effect:<br><br>
                <code>
                @keyframes fadeAnimation {
                    0% {opacity: 0;}
                    100% {opacity: 1;}
                }
                </code><br><br>
                (Inside the div you want to play the animation):<br><br>
                <code>
                animation: fadeAnimation ease 1.5s;
                </code>
            </p>
            <form action="index.html" method="get">
                <button class="button3">Example</button>
            </form>
        </article>

        <article class="EnhanceTwo" id="Example4">
            <h3>Content Targeting</h3>
            <figure>
                <img src="images/jumpToEnhance.gif" alt="Content Target GIF" class="EnhancePageimg">
                <figcaption>About Page by Josh Celestino</figcaption>
            </figure>
            <p>We added code that jumps to an ID declared somewhere on the page.<br><br>
                This goes above and beyond what the task required as adding a smooth<br>
                scroll effect to the page and referencing an ID in the href section was<br>
                not taught to us.<br><br>
                This is the code we used for the effect:<br><br>
                <code>
                html {
                    scroll-behavior: smooth;
                    background-color: black;
                }
                </code><br><br>
                and placing this in the link area of the button:<br><br>
                <code>
                a href="#JumpToID"
                </code>
            </p>
            <form action="about.html" method="get">
                <button class="button3">Example</button>
            </form>
        </article>

        <article class="EnhanceThree" id="Example5">
            <h3>Transparent Text Boxes</h3>
            <figure>
                <img src="images/TransparentBoxes.gif" alt="Content Target GIF" class="EnhancePageimg">
                <figcaption>Enhancement Page by Josh Celestino</figcaption>
            </figure>
            <p>We applied backdrop filter to blur and make the<br>
                background of each text box transparent, giving a smooth<br>
                effect found throughout the entirety of our website.<br><br>
                This goes above and beyond as the use of opacity was not taught<br>
                to use during the lectures and required study outside of the curriculum to learn.<br><br>
                This is the code we used for the effect:<br><br>
                <code>
                background-color: rgba(39, 39, 39, 0.61);
                backdrop-filter: blur(5px);
                </code>
            </p>
            <form action="#Example1" method="get">
                <button class="button3">Example</button>
            </form>
        </article>
    </section>
</body>
</html>
