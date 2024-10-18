<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navs.css">
</head>
<body>
<nav class="navbar">
    <h1>Super Market Management System</h1>
    <div class="Nav_menus">
        <a href="staffdash.php" class="menus">Home</a>
        
        <div class="dropdown">
            <button class="dropdown-toggle">CATEGORIES</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="staffcategory.php">Categories</a></li>
            </ul>
        </div> 

        <div class="dropdown">
            <button class="dropdown-toggle">VIEW ITEMS</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="staffitem.php">View Items</a></li>
                <li><a class="dropdown-item" href="staffitemadd.php">Add Items</a></li>
            </ul>
        </div> 

        <a href="viewbook.php" class="menus">View Bookings</a>
        <a href="index.html" class="menus">Logout</a>
    </div>
</nav>

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const menu = button.nextElementSibling;
            menu.classList.toggle('show');
        });
    });

    // Close dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    };
</script>

</body>
</html>
