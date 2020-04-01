<?php
    require('model/database.php');
    require('model/vehicle_db.php');
    require('model/type_db.php');
    require('model/class_db.php');
    require('model/make_db.php');

    $name = 'user';
    $value = '87';
    $expire = strtotime('0');
    $path = '/';
    setcookie($name, $value, $expire, $path);

    $lifetime = 60 * 60 * 24 * 365; 
    session_set_cookie_params($lifetime,'/');
    session_start();

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_vehicles';
        }
    }

    if ($action == 'list_vehicles') {
        $type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
        $class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);
        $make = filter_input(INPUT_GET, 'make');
        $sort = filter_input(INPUT_GET, 'sort');

        switch ($sort):
            case "price":
                break;
            case "year":
                break;
            default:
                $sort = "price"; //if NULL, FALSE, or anything other than price or year
        endswitch;

        if ($type_id != NULL && $type_id != FALSE) {
            $type_name = get_type_name($type_id);
            $vehicles = get_vehicles_by_type($type_id, $sort);
        } else if ($class_id != NULL && $class_id != FALSE) {
            $class_name = get_class_name($class_id);
            $vehicles = get_vehicles_by_class($class_id, $sort);
        } else if ($make != NULL && $make != FALSE) {
            $vehicles = get_vehicles_by_make($make, $sort);
        } else {
            $vehicles = get_all_vehicles($sort);
        }
        // use in drop menus 
        $types = get_types();
        $classes = get_classes();
        $makes = get_makes();
        include('view/header.php');
        include('vehicle_list.php');
        include('view/footer.php');
    } else if ($action == 'list_types') {
        $types = get_types();
        include('type_list.php');
    } else if ($action == 'list_classes') {
        $classes = get_classes();
        include('class_list.php');
    } else if ($action == 'delete_vehicle') {
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
        if ($vehicle_id == NULL || $vehicle_id == FALSE) {
            $error = "Missing or incorrect vehicle id.";
            include('errors/error.php');
        } else {
            delete_vehicle($vehicle_id);
            header("Location: .?class_id=$class_id"); //Zippys Back End page
        }
    } else if ($action == 'delete_type') {
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        if ($type_id == NULL || $type_id == FALSE) {
            $error = "Missing or incorrect type id.";
            include('errors/error.php');
        } else {
            delete_type($type_id);
            header("Location: .?action=list_types");
        }
    } else if ($action == 'delete_class') {
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
        if ($class_id == NULL || $class_id == FALSE) {
            $error = "Missing or incorrect class id.";
            include('errors/error.php');
        } else {
            delete_class($class_id);
            header("Location: .?action=list_classes");
        }
    } else if ($action == 'show_add_form') {
        $classes = get_classes();
        $types = get_types();
        include('add_vehicle_form.php');
    } else if ($action == 'add_vehicle') {
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);
        $year = filter_input(INPUT_POST, 'vyear', FILTER_VALIDATE_INT);
        $make = filter_input(INPUT_POST, 'make');
        $model = filter_input(INPUT_POST, 'model');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        if ($type_id == NULL || $type_id == FALSE || $class_id == NULL || $class_id == FALSE || $year == NULL || $make == NULL || $model == NULL || $price == NULL ) {
            $error = "Invalid vehicle data. Check all fields and try again.";
            include('errors/error.php');
        } else {
            add_vehicle($type_id, $class_id, $year, $make, $model, $price);
            header("Location: .");
        }
    } else if ($action == 'add_type') {
        $type_name = filter_input(INPUT_POST, 'type_name');
        add_type($type_name);
        header("Location: .?action=list_types");
    } else if ($action == 'add_class') {
        $class_name = filter_input(INPUT_POST, 'class_name');
        add_class($class_name);
        header("Location: .?action=list_classes");
    } else if ($action == 'register') {
        $_SESSION['firstname'] = filter_input(INPUT_GET, 'firstname');
        include('register.php');
    } else if ($action == 'logout') {
        include('logout.php');
        unset($_SESSION['name']);
        $_SESSION = array();
        session_destroy();

        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure,$httponly);
    }
?> 

   