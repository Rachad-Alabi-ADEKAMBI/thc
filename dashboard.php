<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau de bord - Livraison de Salade de Fruits</title>
        <link rel="stylesheet" href="dashboard.css">
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>

    <body>
        <div class="dashboard">
            <aside class="sidebar">
                <div class="logo">
                    <i data-lucide="fruit-bowl" aria-hidden="true"></i>
                    <span>FruitSalad</span>
                </div>
                <nav>
                    <ul>
                        <li class="active"><a href="#commandes"><i data-lucide="shopping-bag" aria-hidden="true"></i>
                                Mes commandes</a></li>
                        <li><a href="#parrainages"><i data-lucide="users" aria-hidden="true"></i> Mes parrainages</a>
                        </li>
                        <li><a href="#abonnement"><i data-lucide="credit-card" aria-hidden="true"></i> Mon
                                abonnement</a></li>
                    </ul>
                </nav>
            </aside>
            <main class="content">
                <header>
                    <button id="menu-toggle" class="menu-toggle">
                        <i data-lucide="layout-dashboard" aria-hidden="true"></i>
                    </button>
                    <h1>Tableau de bord</h1>
                    <div class="user-info">
                        <span>Bonjour, Alice</span>
                        <img src="https://i.pravatar.cc/40?img=1" alt="Photo de profil" class="avatar">
                    </div>
                </header>
                <section id="commande-a-venir" class="active">
                    <h2>Commande à venir</h2>
                    <div class="card">
                        <div class="flex-between">
                            <div>
                                <h3>Salade Tropicale</h3>
                                <p>Livraison prévue le 18/06/2023</p>
                            </div>
                            <button class="btn btn-secondary">Modifier</button>
                        </div>
                    </div>
                </section>
                <section id="commandes">
                    <div class="flex-between">
                        <h2>Mes commandes</h2>
                        <button class="btn btn-primary">Programmer mes commandes</button>
                    </div>
                    <div class="card">
                        <h3>Dernières commandes</h3>
                        <div class="table-container">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Salade</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>15/06/2023</td>
                                        <td><i data-lucide="apple" aria-hidden="true"></i> Salade Tropicale</td>
                                        <td><span class="status delivered">Livrée</span></td>
                                    </tr>
                                    <tr>
                                        <td>12/06/2023</td>
                                        <td><i data-lucide="banana" aria-hidden="true"></i> Salade Vitaminée</td>
                                        <td><span class="status delivered">Livrée</span></td>
                                    </tr>
                                    <tr>
                                        <td>09/06/2023</td>
                                        <td><i data-lucide="cherry" aria-hidden="true"></i> Salade Gourmande</td>
                                        <td><span class="status delivered">Livrée</span></td>
                                    </tr>
                                    <tr>
                                        <td>06/06/2023</td>
                                        <td><i data-lucide="grape" aria-hidden="true"></i> Salade Exotique</td>
                                        <td><span class="status delivered">Livrée</span></td>
                                    </tr>
                                    <tr>
                                        <td>03/06/2023</td>
                                        <td><i data-lucide="lemon" aria-hidden="true"></i> Salade Agrumes</td>
                                        <td><span class="status delivered">Livrée</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination">
                            <button class="btn btn-icon"><i data-lucide="chevron-left" aria-hidden="true"></i></button>
                            <span>Page 1 sur 3</span>
                            <button class="btn btn-icon"><i data-lucide="chevron-right" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </section>
                <section id="parrainages">
                    <h2>Mes parrainages</h2>
                    <div class="card">
                        <h3>Parrainages actifs</h3>
                        <p>Vous avez 3 amis parrainés</p>
                        <div class="fruit-icons">
                            <i data-lucide="apple" aria-hidden="true"></i>
                            <i data-lucide="banana" aria-hidden="true"></i>
                            <i data-lucide="cherry" aria-hidden="true"></i>
                        </div>
                    </div>
                </section>
                <section id="abonnement">
                    <h2>Mon abonnement</h2>
                    <div class="card">
                        <h3>Plan actuel</h3>
                        <p>Premium - 3 livraisons par semaine</p>
                        <div class="fruit-icons">
                            <i data-lucide="apple" aria-hidden="true"></i>
                            <i data-lucide="banana" aria-hidden="true"></i>
                            <i data-lucide="cherry" aria-hidden="true"></i>
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <script>
            lucide.createIcons();
            document.addEventListener('DOMContentLoaded', () => {
                const sidebarNavItems = document.querySelectorAll('.sidebar nav ul li');
                const dashboardNavItems = document.querySelectorAll('.dashboard-nav ul li');
                const sections = document.querySelectorAll('section');
                const menuToggle = document.getElementById('menu-toggle');
                const dashboardNav = document.querySelector('.dashboard-nav');

                function setActiveSection(targetId) {
                    sections.forEach(s => s.classList.remove('active'));
                    document.getElementById(targetId).classList.add('active');

                    dashboardNavItems.forEach(item => {
                        if (item.querySelector('a').getAttribute('href') === '#' + targetId) {
                            item.classList.add('active');
                        } else {
                            item.classList.remove('active');
                        }
                    });
                }

                sidebarNavItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        e.preventDefault();
                        const targetId = item.querySelector('a').getAttribute('href').slice(1);
                        setActiveSection(targetId);
                        sidebarNavItems.forEach(i => i.classList.remove('active'));
                        item.classList.add('active');
                    });
                });

                dashboardNavItems.forEach(item => {
                    item.addEventListener('click', (e) => {
                        e.preventDefault();
                        const targetId = item.querySelector('a').getAttribute('href').slice(1);
                        setActiveSection(targetId);
                    });
                });

                menuToggle.addEventListener('click', () => {
                    dashboardNav.classList.toggle('open');
                });

                window.addEventListener('resize', () => {
                    if (window.innerWidth > 768) {
                        dashboardNav.classList.remove('open');
                    }
                });
            });
        </script>
    </body>

</html>