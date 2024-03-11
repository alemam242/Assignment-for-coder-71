<?php
require('db.php');
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Review</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/toastify.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>


    <script src="assets/js/toastify-js.js"></script>
    <script src="assets/js/axios.min.js"></script>
    <script src="assets/js/config.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>

    <style>
        .clickable {
            font-size: 20px;
            color: #FFD43B;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
            <span></span>
        </div>
    </div>

    <!-- <div id="contentRef" class="content"> -->
    <div class="container-fluid">
        <!-- Show Data -->
    </div>



    <script>
        showLoader();

        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }
    </script>

    <script>
        $().ready(function() {
            hideLoader();

            storeReview();

            async function storeReview() {
                showLoader();
                try {
                    const res = await axios.post('/store_product_review.php', {
                        user_id: 20,
                        product_id: 747,
                        review: "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea velit fugiat vel?"
                    });

                    if(res.data.status === 'success'){
                        successToast(res.data.message);
                    }else{
                        errorToast(res.data.message);
                    }

                    console.log(res.data);
                } catch (error) {
                    errorToast("Request failed.");
                    console.log(error.message);
                } finally {
                    hideLoader();
                }


            }
        });
    </script>

</body>

</html>