<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../../connect/connectDB.php');

$users = executeResult("SELECT * FROM tb_user WHERE role = 1");
?>
<style>
    .filter-product .form-search-header {
        top: 30%;
        position: relative;
        width: 300px;
    }

    .filter-product .form-search-header .icon {
        color: #777e90;
        position: absolute;
        top: 9px;
        left: 10px;
        font-size: 16px;
    }

    .filter-product .form-search-header input {
        border-radius: 20px;
        padding-left: 30px;
        margin-bottom: 20px;
    }

    .filter-product .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }

    .filter-product .form-control {
        display: block;
        width: 100%;
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>

<div class="products">
    <h1>Customer Management</h1>
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-Cus" type="text" name="search" placeholder="Search ..." class="form-control">
        </div>
    </div>
</div>

<div class="container-filter-table-sale">
    <div class="filter-action">
        <div class="select-container">
            <select name="category" class="select-box" id="arrangeCus">
                <option value="all">__All Customer__ </option>
                <option value="new_to_old">New to Old </option>
                <option value="old_to_new">Old to New</option>
                <option value="Active">Active</option>
                <option value="Deactive">Deactive</option>
            </select>
        </div>
    </div>
    <div class="table-sale-box"></div>
</div>
</div>
</div>

<script type="text/javascript">
    function deactivateUser(userId) {
        if (confirm("Are you sure you want to deactivate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: {
                    code: userId
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("User deactivated successfully!");
                    } else {
                        alert("Failed to deactivate user.");
                    }
                }
            });
        }
    }

    function ActivateUser(userId) {
        if (confirm("Are you sure you want to Activate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: {
                    id: userId
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("User Activated successfully!");
                    } else {
                        alert("Failed to Activate user.");
                    }
                }
            });
        }
    }



    function showCus() {
        $.ajax({
            url: "handles/search/filter_search_customer.php",
            method: "POST",
            data: {
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    }

    $(document).ready(function() {
        showCus();

        $("#filter-search-Cus").on("input", function() {
            const search = $(this).val();
            if (search !== "") {
                $.ajax({
                    url: "handles/search/filter_search_customer.php",
                    method: "POST",
                    data: {
                        filter_search: search,
                        arrangeCustomer: $("#arrangeCus").val()
                    },
                    success: function(res) {
                        $(".table-sale-box").empty().html(res);
                    }
                });
            } else {
                showCus();
            }
        });

        $("#arrangeCus").on("change", function() {
            const arrangeCus = $(this).val();
            $.ajax({
                url: "handles/search/filter_search_customer.php",
                method: "POST",
                data: {
                    filter_search: $("#filter-search-Cus").val(),
                    arrangeCustomer: arrangeCus
                },
                success: function(res) {
                    $(".table-sale-box").empty().html(res);
                }
            });
        });
    })



    function product_previous(id) {
        $.ajax({
            url: "handles/search/filter_search_customer.php",
            method: "POST",
            data: {
                page: id - 1,
                filter_search: $("#filter-search-Cus").val(),
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };

    function product_next(id) {
        $.ajax({
            url: "handles/search/filter_search_customer.php",
            method: "POST",
            data: {
                page: (id + 1),
                filter_search: $("#filter-search-Cus").val(),
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };
    
</script>