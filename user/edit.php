<?php

session_start();

if (!isset($_SESSION['user_id']))
{
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    Edit Profile
                </div>

                <div class="card-body">

                    <div id="message"></div>

                    <form id="editForm">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label>Forenames</label>

                                <input
                                    type="text"
                                    id="forenames"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>Surname</label>

                                <input
                                    type="text"
                                    id="surname"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Mobile Phone</label>

                            <input
                                type="text"
                                id="mobile_phone"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label>Other Phone</label>

                            <input
                                type="text"
                                id="other_phone"
                                class="form-control">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            Update Profile

                        </button>

                        <a
                            href="dashboard.php"
                            class="btn btn-secondary">

                            Back

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

async function loadUser()
{
    try
    {
        const response =
        await fetch(
            '../api/user.php'
        );

        const result =
        await response.json();

        if(result.status)
        {
            document.getElementById(
                'forenames'
            ).value =
            result.data.forenames || '';

            document.getElementById(
                'surname'
            ).value =
            result.data.surname || '';

            document.getElementById(
                'mobile_phone'
            ).value =
            result.data.mobile_phone || '';

            document.getElementById(
                'other_phone'
            ).value =
            result.data.other_phone || '';
        }
        else
        {
            document.getElementById(
                'message'
            ).innerHTML =
            `<div class="alert alert-danger">
                ${result.message}
            </div>`;
        }

    }
    catch(error)
    {
        console.log(error);
    }
}

loadUser();

document
.getElementById('editForm')
.addEventListener(
'submit',
async function(e)
{
    e.preventDefault();

    try
    {
        const response =
        await fetch(
            '../api/user.php',
            {
                method: 'PUT',

                headers:
                {
                    'Content-Type':
                    'application/json'
                },

                body: JSON.stringify({

                    forenames:
                    document.getElementById(
                        'forenames'
                    ).value,

                    surname:
                    document.getElementById(
                        'surname'
                    ).value,

                    mobile_phone:
                    document.getElementById(
                        'mobile_phone'
                    ).value,

                    other_phone:
                    document.getElementById(
                        'other_phone'
                    ).value

                })
            }
        );

        const result =
        await response.json();

        if(result.status)
        {
            document.getElementById(
                'message'
            ).innerHTML =
            `<div class="alert alert-success">
                ${result.message}
            </div>`;
        }
        else
        {
            document.getElementById(
                'message'
            ).innerHTML =
            `<div class="alert alert-danger">
                ${result.message}
            </div>`;
        }

    }
    catch(error)
    {
        console.log(error);
    }

});

</script>

</body>
</html>