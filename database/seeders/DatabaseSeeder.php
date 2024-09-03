<?php

namespace Database\Seeders;

use App\Models\Constant;
use App\Models\Delivrable;
use App\Models\DelivrableMode;
use App\Models\Page;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        /*Page::create(['title' => "Privacy Ploicy", 'content' => $faker->realText]);
        Page::create(['title' => "Terms And Condition", 'content' => $faker->realText]);
        Page::create([
            'title' => "We Help You Find and Hire the Right Professionals",
            'title_fr' => "Nous vous aidons à trouver et à embaucher les bons professionnels",
            'content' => 'Transform your home effortlessly with our curated network of skilled professionals. From plumbing to landscaping, we connect you with trusted experts for every task, ensuring peace of mind and satisfaction with every project.',
            'content_fr' => 'Transformez votre maison facilement avec notre réseau sélectionné de professionnels qualifiés. De la plomberie à l\'aménagement paysager, nous vous mettons en relation avec des experts de confiance pour chaque tâche, garantissant la tranquillité d\'esprit et la satisfaction à chaque projet.'
        ]);
        Page::create([
            'title' => "Our Search Feature to Filter Professionals",
            'title_fr' => "Notre fonction de recherche pour filtrer les professionnels",
            'content' => 'Discover the perfect professional for your needs with our advanced search and filter functionality. Easily narrow down your options by location, services offered, ratings, and more, ensuring you find the ideal expert to transform your home. Say goodbye to endless scrolling and hello to efficiency with our intuitive search feature.',
            'content_fr' => 'Découvrez le professionnel parfait pour vos besoins avec notre fonctionnalité de recherche et de filtrage avancée. Réduisez facilement vos options par emplacement, services offerts, notes, et plus encore, pour vous assurer de trouver l\'expert idéal pour transformer votre maison. Dites adieu au défilement sans fin et bonjour à l\'efficacité avec notre fonction de recherche intuitive.'
        ]);
        Page::create([
            'title' => "Real-Time Booking and Updates",
            'title_fr' => "Réservations et mises à jour en temps réel",
            'content' => 'Experience seamless booking and stay informed every step of the way with our real-time booking and updates feature. Schedule appointments with ease and receive instant confirmations, job status updates, and notifications. With our platform, you\'ll never be left in the dark, ensuring a stress-free and transparent home service experience.',
            'content_fr' => 'Profitez de réservations sans couture et restez informé à chaque étape avec notre fonctionnalité de réservation et de mises à jour en temps réel. Planifiez des rendez-vous facilement et recevez des confirmations instantanées, des mises à jour de l\'état du travail et des notifications. Avec notre plateforme, vous ne serez jamais laissé dans le noir, garantissant une expérience de service à domicile sans stress et transparente.'
        ]);
        Page::create([
            'title' => "How It Works",
            'title_fr' => "Comment ça fonctionne",
            'content' => 'Discover how Pro4Home streamlines home services. From finding professionals to booking, we make it effortless.',
            'content_fr' => 'Découvrez comment Pro4Home simplifie les services à domicile. De la recherche de professionnels à la réservation, nous le rendons facile.'
        ]);
        Page::create([
            'title' => "About Footer",
            'title_fr' => "À propos du pied de page",
            'content' => 'Pro4Home: Your go-to platform for hassle-free home improvements. Connect with trusted professionals and simplify your home projects.',
            'content_fr' => 'Pro4Home : Votre plateforme de référence pour des améliorations domiciliaires sans tracas. Connectez-vous avec des professionnels de confiance et simplifiez vos projets domiciliaires.'
        ]);
        Page::create([
            'title' => "Join Pro4Home Expand Your Reach, Grow Your Business",
            'title_fr' => "Rejoignez Pro4Home, Élargissez votre portée, Développez votre entreprise",
            'content' => 'Join our network of skilled professionals and gain access to a wide range of clients seeking your expertise. Showcase your skills and connect with clients effortlessly. Grow your home service business with us today!',
            'content_fr' => 'Rejoignez notre réseau de professionnels qualifiés et accédez à une large gamme de clients recherchant votre expertise. Mettez en valeur vos compétences et connectez-vous avec les clients sans effort. Développez votre entreprise de services à domicile avec nous dès aujourd\'hui!'
        ]);
        Page::create([
            'title' => "How to Get Started",
            'title_fr' => "Comment commencer",
            'content' => 'Begin your journey with Pro4Home in just a few simple steps. Download the app, sign up, and start browsing opportunities today!',
            'content_fr' => 'Commencez votre parcours avec Pro4Home en quelques étapes simples. Téléchargez l\'application, inscrivez-vous et commencez à parcourir les opportunités dès aujourd\'hui!'
        ]);
        Page::create([
            'title' => "The Best Hiring Platform for Professionals",
            'title_fr' => "La meilleure plateforme de recrutement pour les professionnels",
            'content' => 'Experience seamless hiring like never before with Pro4Home. Connect with skilled professionals effortlessly and transform your home with confidence.',
            'content_fr' => 'Découvrez un recrutement sans faille comme jamais auparavant avec Pro4Home. Connectez-vous facilement avec des professionnels qualifiés et transformez votre maison en toute confiance.'
        ]);
        Page::create([
            'title' => "Advanced Search Functionality",
            'title_fr' => "Fonctionnalité de recherche avancée",
            'content' => 'Find the perfect professional for your needs with our advanced search feature. Filter by location, services offered, ratings, and more to narrow down your options and discover the ideal expert for your project.',
            'content_fr' => 'Trouvez le professionnel parfait pour vos besoins avec notre fonctionnalité de recherche avancée. Filtrez par emplacement, services offerts, notes et plus encore pour réduire vos options et découvrir l\'expert idéal pour votre projet.'
        ]);
        Page::create([
            'title' => "Real-Time Booking and Updates",
            'title_fr' => "Réservations et mises à jour en temps réel",
            'content' => 'Experience seamless booking and stay informed every step of the way with our real-time booking and updates feature. Schedule appointments with ease, receive instant confirmations, and get notified of job status updates. With Pro4Home, you\'ll always be in the loop, ensuring a stress-free and transparent home service experience.',
            'content_fr' => 'Profitez de réservations sans couture et restez informé à chaque étape avec notre fonctionnalité de réservation et de mises à jour en temps réel. Planifiez des rendez-vous facilement, recevez des confirmations instantanées et soyez informé des mises à jour de l\'état du travail. Avec Pro4Home, vous serez toujours informé, garantissant une expérience de service à domicile sans stress et transparente.'
        ]);
        Page::create([
            'title' => "Profile Customization Tools",
            'title_fr' => "Outils de personnalisation de profil",
            'content' => 'Stand out to potential clients by customizing your Pro4Home profile. Showcase your skills, certifications, and portfolio to build trust and attract more business. With our profile customization tools, you can highlight what makes you unique and increase your chances of getting hired.',
            'content_fr' => 'Démarquez-vous auprès des clients potentiels en personnalisant votre profil Pro4Home. Mettez en valeur vos compétences, certifications et portfolio pour inspirer confiance et attirer plus d\'affaires. Avec nos outils de personnalisation de profil, vous pouvez mettre en avant ce qui vous rend unique et augmenter vos chances d\'être embauché.'
        ]);
        Page::create([
            'title' => "Our Address",
            'title_fr' => "Notre adresse",
            'content' => "Carrefour Yoro Joss, Bonamoussadi Douala, Cameroon",
            'content_fr' => "Carrefour Yoro Joss, Bonamoussadi Douala, Cameroun"
        ]);
        Page::create([
            'title' => "Call Us",
            'title_fr' => "Appelez-nous",
            'content' => "+237 987 889 874<br>+237 658 985 899",
            'content_fr' => "+237 987 889 874<br>+237 658 985 899"
        ]);
        Page::create([
            'title' => "Write Us",
            'title_fr' => "Écrivez-nous",
            'content' => "info@pro4home.com<br>support@pro4home.com",
            'content_fr' => "info@pro4home.com<br>support@pro4home.com"
        ]);
        Page::create([
            'title' => "App Store",
            'title_fr' => "App Store",
            'content' => "https://www.google.com/",
            'content_fr' => "https://www.google.com/"
        ]);
        Page::create([
            'title' => "Play Store",
            'title_fr' => "Play Store",
            'content' => "https://www.google.com/",
            'content_fr' => "https://www.google.com/"
        ]);
        Page::create([
            'title' => "Facebook",
            'title_fr' => "Facebook",
            'content' => "https://www.google.com/",
            'content_fr' => "https://www.google.com/"
        ]);
        Page::create([
            'title' => "Twitter",
            'title_fr' => "Twitter",
            'content' => "https://www.google.com/",
            'content_fr' => "https://www.google.com/"
        ]);
        Page::create([
            'title' => "Youtube",
            'title_fr' => "Youtube",
            'content' => "https://www.google.com/",
            'content_fr' => "https://www.google.com/"
        ]);

        User::create([
            'user_name' => "admin",
            'phone' => "1234567",
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make("password"),
        ]);
        User::create([
            'user_name' => "user",
            'phone' => "1234567",
            'email' => 'user@gmail.com',
            'role' => 'normal',
            'password' => Hash::make("12345678"),
        ]);

        School::create([
            'name' => "University of Buea",
        ]);

        Delivrable::create([
            'name' => "Transcript",
            'school_id' => 1,
            'price' => 1000,
            'duration' => 14
        ]);

        DelivrableMode::create([
            'name' => "Fast",
            'delivrable_id' =>1,
            'price' => 2000,
            'duration' => 7
        ]);
        DelivrableMode::create([
            'name' => "SuperFast",
            'delivrable_id' =>1,
            'price' => 3000,
            'duration' => 2
        ]);

        Constant::create([
            'name' => "Referal Price",
            'value' => "100",
        ]);

        Constant::create([
            'name' => "Minimum Withdraw",
            'value' => "1000",
        ]);

        Constant::create([
            'name' => "Maximum Withdraw",
            'value' => "10000",
        ]); */
        Constant::create([
            'name' => "Scan Copy",
            'value' => "100",
        ]);


        //$this->call(LocationSeerder::class);

    }
}
