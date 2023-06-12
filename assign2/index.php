<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index Page</title>
    <link rel="stylesheet" href="styles/style.css">
    <meta charset="utf-8">
    <meta name="description" content="Landing Page of Website">
    <meta name="keywords" content="HTML5, Index">
    <meta name="author" content="Marcus Green">
</head>

<body>
    <article class="banner">
        <article class="navbar">
            <?php include 'nav.inc'; ?>
        </article>
        <header class="EntryText">
            <h1 class="LP">The Boys & Co.</h1>
            <p class="text1">Hello and welcome to <strong>The Boys & Co.'s</strong> website. We are a growing tech company with facilities in 4 countries. We offer a range of IT services, from Database management to front-end development. We are currently searching for new workers to join our family, specifically a Database Administrator, as well as a Full stack developer. If interested, click Apply Now! If you need more information, click learn more.</p>
            <form action="apply.html" method="get">
                <button class="button1">Apply Now!</button>
            </form>
            <form action="https://youtu.be/15XIT44ELVI" method="get">
                <button class="button2">See How It's Made</button>
            </form>
            <form action="https://youtu.be/7wy7p2B2CzA" method="get">
                <button class="button2">See How The PHP is Made</button>
            </form>
        </header>
    </article>
    <?php include 'footer.inc'; ?>
</body>
</html>
