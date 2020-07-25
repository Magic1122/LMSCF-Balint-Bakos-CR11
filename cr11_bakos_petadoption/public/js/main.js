// Making our AJAX request and rendering our content based on the pathname

const locationAnimals = window.location.pathname === '/cr11_bakos_petadoption/animals'
const locationSandL = window.location.pathname === '/cr11_bakos_petadoption/animals/general'
const locationSenior = window.location.pathname === '/cr11_bakos_petadoption/animals/senior'
const locationAdmin = window.location.pathname === '/cr11_bakos_petadoption/animals/admin'
const locationRoot = window.location.pathname === '/cr11_bakos_petadoption/users/root'

const projectName = window.location.pathname.split('/')[1]
const host = window.location.host

const renderAnimals = (searchText = '') => {
    console.log(host)

    $.ajax({
        type: "POST",
        url: `http://${host}/${projectName}/searches/index/${searchText}`,


        dataType: "json",
        success: function (response) {
            const animals = response
            console.log(animals)

            $('#small').empty()
            $('#large').empty()
            $('#senior').empty()

            animals.map((animal) => {

                const html =
                    `<div class="col-12 col-md-6 col-lg-3">
                <div class="card mb-4 bg-white searchText-dark">
                    <img class="pet-picture" src=${animal.animal_img} class="d-inline-block d-none d-md-inline-block card-img-top" alt="picture of an animal">
                    <div class="card-body">
                        <h5 class="card-title">${animal.animal_name}</h5>
                        <p class="card-searchText">Breed: ${animal.breed}</p>
                        <p class="card-searchText">Age: ${animal.animal_age} year${animal.animal_age === '1' ? '' : 's'}</p>
                        <p>Lives in ${animal.location_city}</p>
                        <a href="http://${host}/${projectName}/animals/show/${animal.animal_id}" class="btn btn-dark">Show Pet</a>
                    </div>
                </div>
            </div>`

                if (animal.type === 'small' && (locationAnimals || locationSandL)) {
                    $('#small').append(html)
                } else if (animal.type === 'large' && (locationAnimals || locationSandL)) {
                    $('#large').append(html)
                } else if (animal.type === 'senior' && (locationAnimals || locationSenior)) {
                    $('#senior').append(html)
                }
            })
        }
    });
}

const renderAdmin = (searchText = '') => {

    $.ajax({
        type: "POST",
        url: `http://${host}/${projectName}/searches/admin/${searchText}`,


        dataType: "json",
        success: function (response) {
            const animals = response
            console.log(animals)

            $('#animals').empty()

            let html = `
            <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Breed</th>
                <th scope="col">Location</th>
                <th scope="col">Picture</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                          
            `

            animals.map((animal) => {

                html +=
                    `<tr>
                <th scope="row">${animal.animal_id}</th>
                <td>${animal.animal_name}</td>
                <td>${animal.type}</td>
                <td>${animal.breed}</td>
                <td>${animal.location_city}</td>
                <td><img src=${animal.animal_img} alt="animal picture"/ style="width: 60px;"></td>
                <td class="d-flex justify-content-between" >
                <a href="http://${host}/${projectName}/animals/show/${animal.animal_id}" class="btn btn-success">More</a>
                <a href="http://${host}/${projectName}/animals/edit/${animal.animal_id}" class="btn btn-warning">Edit</a>
                <form action="http://${host}/${projectName}/animals/delete/${animal.animal_id}" method="POST">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
                </td>
              </tr>`
            });

            html += `</tbody>
                </table>`

            $('#animals').append(html)

        }
    })
}

const renderRoot = (searchText = '') => {

    $.ajax({
        type: "POST",
        url: `http://${host}/${projectName}/searches/root/${searchText}`,


        dataType: "json",
        success: function (response) {
            const users = response
            console.log(users)

            $('#users').empty()

            let html = `
            <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                          
            `

            users.map((user) => {

                html +=
                    `<tr>
                <th scope="row">${user.id}</th>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.created_at}</td>
                <td>
                <form action="http://${host}/${projectName}/users/delete/${user.id}" method="POST">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
                </td>
              </tr>`
            });

            html += `</tbody>
                </table>`

            $('#users').append(html)

        }
    })



}

if (locationRoot) {

    const form = document.getElementById('search-form')
    console.log(form)

    form.addEventListener('input', (e) => {
        const searchText = e.target.value
        console.log(searchText)
        renderRoot(searchText)

    })

    renderRoot()
}

if (locationAdmin) {

    const form = document.getElementById('search-form')
    console.log(form)

    form.addEventListener('input', (e) => {
        const searchText = e.target.value
        console.log(searchText)
        renderAdmin(searchText)

    })
    renderAdmin()
}




if (locationAnimals || locationSandL || locationSenior) {

    console.log(window.location.pathname)

    const form = document.getElementById('search-form')
    console.log(form)

    form.addEventListener('input', (e) => {
        const searchText = e.target.value
        console.log(searchText)
        renderAnimals(searchText)



    })

    renderAnimals()
}



// Manipulating the available input fields regarding the logic
// Senior is from 8 years, so small and large should be disabled if the age is = or bigger than 8

// Getting the inputs

$(document).ready(() => {

    const ageInput = $('#age')
    const type = $('#type')
    const option1 = $('#1')
    const option2 = $('#2')
    const option3 = $('#3')

    const onAgeValue = (age) => {

        if (!age) {
            option1.attr('disabled', false)
            option2.attr('disabled', false)
            option3.attr('disabled', false)

        } else if (age >= 8) {

            if (type.val() == '1' || type.val() == '2' || type.val() == '') {
                type.val('')
                type.value = ''
            }

            option1.attr('disabled', true)
            option2.attr('disabled', true)
            option3.attr('disabled', false)

        } else if (age < 8) {
            console.log(type.val())
            if (type.val() == '3') {
                type.val('')
                type.value = ''
            }
            option1.attr('disabled', false)
            option2.attr('disabled', false)
            option3.attr('disabled', true)
        }
    }

    onAgeValue(ageInput.val())

    ageInput.on('input', (e) => {
        const age = parseInt(e.target.value)
        console.log(age)

        onAgeValue(age)
    })


})