<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Physical Development Plans in Kilimani, Nairobi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-body {
            flex: 1;
        }
        .card-footer {
            background: white;
            border-top: none;
        }
        .header {
            display: flex;
            align-items: center;
            background-color: #f19f39;
            padding: 10px 20px;
        }
        .header img {
            height: 80px;
            width: auto;
            margin-right: 20px;
        }
        .header h3 {
            color: white;
            margin: 0 20px 0 0;
            flex-shrink: 0;
        }
        .menu-container {
            position: relative;
        }
        .main-menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f19f39;
            padding: 10px;
            flex-wrap: wrap;
        }
        .menu-logo {
            display: flex;
            align-items: center;
        }
        .menu-logo img {
            height: 40px; /* Adjust as needed */
            margin-right: 10px;
        }
        .menu-logo h3 {
            color: white;
            margin: 0;
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            color: white;
            background-color: #333;
            border: none;
            cursor: pointer;
        }
        .menu-toggle:hover {
            background-color: #10a04a;
        }
        .menu-items {
            display: flex;
            gap: 20px;
        }
        .menu-items a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
        }
        .menu-items a:hover {
            background-color: #10a04a;
        }
        @media (max-width: 600px) {
            .menu-toggle {
                display: block;
            }
            .menu-items {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #333;
                position: absolute;
                top: 50px;
                left: 0;
                z-index: 1000;
            }
            .menu-items.show {
                display: flex;
            }
            .menu-items a {
                padding: 15px;
                width: 100%;
                text-align: center;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
<div class="menu-container">
        <nav class="main-menu">
            <div class="menu-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <h3>Lenana Team</h3>
            </div>
            <div class="menu-logo">
                <img src="{{ asset('images/qr.png') }}" alt="Logo">
            </div>
            <button class="menu-toggle" aria-label="Toggle menu">&#9776;</button>
            <div class="menu-items">
                <a href="{{url('/')}}" class="menu-item">Roads</a>
                <a href="{{url('security')}}" class="menu-item">Security</a>
                <a href="{{url('upcomingprojects')}}" class="menu-item">Participate</a>
            </div>
        </nav>
    </div>

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu-items').classList.toggle('show');
        });
    </script>
<div class="container mt-5">
    <center><h3 class="mb-4">Upcoming Projects</h3></center>
    <div class="row" id="plans-container">
        <!-- Placeholder for dynamically generated plans -->
    </div>
</div>

<!-- Modal for Public Participation -->
<div class="modal fade" id="participationModal" tabindex="-1" role="dialog" aria-labelledby="participationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="participationModalLabel">Public Participation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="participationForm">
                    <div class="form-group">
                        <label for="participantName">Name</label>
                        <input type="text" class="form-control" id="participantName" required>
                    </div>
                    <div class="form-group">
                        <label for="participantComments">Comments</label>
                        <textarea class="form-control" id="participantComments" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modals for Recommendations -->
<div class="modal fade" id="recommendationsModal1" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel1">Recommendations for Community Park</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations :  2,500,000 participants</h5>
                <div class="card-text">
                    <div class="category">
                        <ul>

                        <li>Enhanced Recreational Facilities: 700,000 participants</li>
                        <li>Improved Accessibility and Inclusivity: 500,000 participants</li>
                        <li>Environmental Conservation Efforts: 600,000 participants</li>
                        <li>Community Engagement Programs: 400,000 participants</li>
                        <li>Safety and Security Enhancements: 300,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recommendationsModal2" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel2">Recommendations for New Library</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations: 1,000,000 participants</h5>
                <div class="card-text">
                    <div class="category">
                      
                        <ul>
                            <li>Digital Resources and Technology Integration: 250,000 participants</li>
                            <li>Expanded Physical Collection: 200,000 participants</li>
                            <li>Community Programs and Workshops: 300,000 participants</li>
                            <li>Enhanced Study and Reading Spaces: 150,000 participants</li>
                            <li>Accessibility and Inclusive Design: 100,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recommendationsModal3" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel3">Recommendations for Road Expansion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations :   2,000,000 participants</h5>
                <div class="card-text">
                    <div class="category">
                        <ul>
                            <li>Improved Traffic Flow and Congestion Management: 500,000 participants</li>
                            <li>Enhanced Road Safety Measures: 400,000 participants</li>
                            <li>Public Transportation Integration: 300,000 participants</li>
                            <li>Environmental Impact Mitigation: 400,000 participants</li>
                            <li>Community Consultation and Engagement: 400,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recommendationsModal4" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel4">Recommendations for Sports Complex</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations</h5>
                <div class="card-text">
                    <div class="category">
                        <h6>Category: Health and Fitness</h6>
                        <ul>
                            <li>Sports Complex: 28,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recommendationsModal5" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel5">Recommendations for Public Housing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations</h5>
                <div class="card-text">
                    <div class="category">
                        <h6>Category: Housing</h6>
                        <ul>
                            <li>Public Housing: 27,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recommendationsModal6" tabindex="-1" role="dialog" aria-labelledby="recommendationsModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recommendationsModalLabel6">Recommendations for Community Center</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Recommendations</h5>
                <div class="card-text">
                    <div class="category">
                        <h6>Category: Community Spaces</h6>
                        <ul>
                            <li>Community Center: 26,000 participants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Sample data for the plans
    const plans = [
        {
            title: 'Community Park',
            area: 'Adams Arcade',
            image: 'https://cdn.modernghana.com/content__/640/457/1110201741648_acommunityparkmequonplayground.jpg',
            startDate: '2024-09-01',
            cost: 'KES 15,000,000',
            impact: 'Provide a recreational space for families and improve local biodiversity.',
            recommendationsId: 'recommendationsModal1'
        },
        {
            title: 'New Library',
            area: 'Yaya Centre',
            image: 'https://media.istockphoto.com/id/1498878143/photo/book-stack-and-open-book-on-the-desk-in-modern-public-library.webp?b=1&s=170667a&w=0&k=20&c=T63zJBKuZLTUQwwAAwLzbMwtzAEdd4wZRaEV6EAdUnA=',
            startDate: '2024-10-15',
            cost: 'KES 3,000,000',
            impact: 'Enhance educational resources and promote literacy in the community.',
            recommendationsId: 'recommendationsModal2'
        },
        {
            title: 'Road Expansion',
            area: 'Lenana Road',
            image: 'https://i0.wp.com/constructionkenyashowcase.com/wp-content/uploads/2024/01/A-section-of-the-road-under-construction-jpg.webp?fit=820%2C547&ssl=1',
            startDate: '2024-11-05',
            cost: 'KES 1,000,000',
            impact: 'Reduce traffic congestion and improve connectivity.',
            recommendationsId: 'recommendationsModal3'
        },
        {
            title: 'Sports Complex',
            area: 'Wood Avenue',
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFu_1JPpMoYQ-eGutt3jqQCY4_bZlSUFEenc1cCVD1ejyHnJjEdcCkyfLT604B1cuJvNI&usqp=CAU',
            startDate: '2024-12-10',
            cost: 'KES 2,000,000',
            impact: 'Promote health and fitness among residents.',
            recommendationsId: 'recommendationsModal4'
        },
        {
            title: 'Public Housing',
            area: 'Chaka Road',
            image: 'https://media.licdn.com/dms/image/D4D12AQE7WEo6P8iH6g/article-cover_image-shrink_720_1280/0/1685451612190?e=2147483647&v=beta&t=vQd5h-6wt1FvLq87sND8IOPqDmU36DFxpiMlZNb8vOQ',
            startDate: '2024-08-20',
            cost: 'KES 7,050,000',
            impact: 'Provide affordable housing solutions for low-income families.',
            recommendationsId: 'recommendationsModal5'
        },
        {
            title: 'Community Center',
            area: 'Kilimani Road',
            image: 'https://landezine-award.com/wp-content/uploads/2022/05/ParkhillGreens-23.jpg',
            startDate: '2024-09-25',
            cost: 'KES 6,000,000',
            impact: 'Create a space for community events and activities.',
            recommendationsId: 'recommendationsModal6'
        }
    ];

    // Function to populate the plans dynamically
    function populatePlans() {
        const container = document.getElementById('plans-container');

        plans.forEach(plan => {
            const card = document.createElement('div');
            card.classList.add('col-md-4', 'mb-4');
            card.innerHTML = `
                <div class="card">
                    <img class="card-img-top" src="${plan.image}" alt="Plan Image">
                    <div class="card-body">
                        <h5 class="card-title">${plan.title}</h5>
                        <p class="card-text"><strong>Area:</strong> ${plan.area}</p>
                        <p class="card-text"><strong>Planned Start Date:</strong> ${plan.startDate}</p>
                        <p class="card-text"><strong>Cost:</strong> ${plan.cost}</p>
                        <p class="card-text"><strong>Impact on the Community:</strong> ${plan.impact}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#participationModal">Participate</button>
                        <button type="button" class="btn btn-secondary btn-block mt-2" data-toggle="modal" data-target="#${plan.recommendationsId}">View Recommendations</button>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    document.addEventListener('DOMContentLoaded', populatePlans);

    // Handle form submission
    document.getElementById('participationForm').addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Thank you for your participation!');
        $('#participationModal').modal('hide');
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
