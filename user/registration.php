<!DOCTYPE html>
<html>
<head>

<title>User Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    User Registration
                </div>

                <div class="card-body">

                    <div id="message"></div>

                    <form id="registrationForm">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Forenames</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="forenames"
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Surname</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="surname"
                                >
                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Title</label>

                            <select
                                class="form-control"
                                id="title">

                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label>Date Of Birth</label>

                            <input
                                type="date"
                                class="form-control"
                                id="dob">

                        </div>

                        <div class="mb-3">

                            <label>Mobile Phone</label>

                            <input
                                type="text"
                                class="form-control"
                                id="mobile_phone">

                        </div>

                        <div class="mb-3">

                            <label>Other Phone</label>

                            <input
                                type="text"
                                class="form-control"
                                id="other_phone">

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                class="form-control"
                                id="email">

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                class="form-control"
                                id="password">

                        </div>

                        <div class="mb-3">

                            <label>Confirm Password</label>

                            <input
                                type="password"
                                class="form-control"
                                id="confirm_password">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            Register

                        </button>
                         <a href="login.php" class="btn btn-danger">
    Login
</a>             

                    </form>

                            
<script>

document
.getElementById('registrationForm')
.addEventListener(
'submit',
async function(e){

e.preventDefault();

let password =
document.getElementById(
'password'
).value;

let confirmPassword =
document.getElementById(
'confirm_password'
).value;

if(password != confirmPassword)
{
    alert(
        'Password does not match'
    );

    return;
}

const response =
await fetch(
'../api/user.php',
{
method:'POST',

headers:{
'Content-Type':
'application/json'
},

body:JSON.stringify({

forenames:
document.getElementById('forenames').value,

surname:
document.getElementById('surname').value,

title:
document.getElementById('title').value,

dob:
document.getElementById('dob').value,

mobile_phone:
document.getElementById('mobile_phone').value,

other_phone:
document.getElementById('other_phone').value,

email:
document.getElementById('email').value,

password:
password

})

});

const result =
await response.json();

document
.getElementById('message')
.innerHTML =
`
<div class="alert alert-info">
${result.message}
</div>
`;

});

</script>
                </div>

            </div>

        </div>

    </div>

</div>