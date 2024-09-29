<nav class="navbar">
        <h1>Super Market Management Sytem </h1>
        <div class="Nav_menus">
            <a href="Admindash.php">
                <div class="menus">Home</div>
            </a>
            <div class="dropdown">
                <button style="background-color: white; color: black; border: none; outline: none;"
                    class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Users
                </button>
                <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item active" href="manageuser.php">Manage user</a></li>
                </ul>
            </div> 
            <div class="dropdown">
                <button style="background-color: white; color: black; border: none; outline: none;"
                    class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Staff
                </button>
                <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item active" href="addstaff.php">Add Staff</a></li>
                    <li><a class="dropdown-item active" href="managestaff.php">Manage Staff</a></li>
                </ul>
            </div> 
            <div class="dropdown">
                <button style="background-color: white; color: black; border: none; outline: none;"
                    class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Items
                </button>
                <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item active" href="aditem.php">Add Items</a></li>
                    <li><a class="dropdown-item active" href="addcategory.php">add category</a></li>
                    <li><a class="dropdown-item active" href="manageitem.php">Manage Items</a></li>
                </ul>
            </div> 
            <a href="index.html">
                <div class="menus">Logout</div>
            </a>
        </div>
    </nav>