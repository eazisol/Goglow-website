@extends('layouts.main')
{{-- Title --}}
@section('title', 'term&conditions')

{{-- Style Files --}}
@section('styles')
    <style>
        .terms-conditions {
            font-size: 13px;
        }
        p{
            margin-top: 10px;
            border-radius: 8px;
            background: aliceblue;
            padding: 10px;
        }
        .terms-text ul li {
            padding-bottom: 8px;
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .terms-text ul li:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

    </style>
@endsection

{{-- Content --}}
@section('content')
    <!-- Page Header Start -->

    <!-- Page Header End -->
	

    <!-- Terms and Conditions Section Start -->
    <div class="terms-conditions bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Terms Content Start -->
                    <div class="terms-content">
                        <div class="terms-text">
                            {{-- <h2>GoGlow - Conditions Générales d'Utilisation</h2> --}}
                            <p class="text-end">Dernière mise à jour : 23 décembre 2025</p>
                                                    <div class="section-title">
                                                        <h3 class="wow">Term & Conditions</h3>
                                                    </div>
                            
                            <h4>1. Introduction</h4>
                            <p>Les présentes Conditions Générales d'Utilisation régissent l'utilisation de l'application mobile GoGlow, exploitée par GoGlow, reliant les clients (Glowees) et les prestataires (Glowers) pour la réservation et la gestion de services de beauté. L'application est destinée aux utilisateurs en France, à Paris et dans l'UE et respecte le RGPD et la législation française sous la supervision de la CNIL.</p>
                            
                            <h4>2. Rôles des Utilisateurs</h4>
                            <ul>
                                <li>Clients (Glowees) : Parcourir, réserver et évaluer des services.</li>
                                <li>Prestataires (Glowers) : Enregistrer, proposer et gérer leurs services et réservations.</li>
                            </ul>
                            <br>
                            
                            <h4>3. Inscription et Compte</h4>
                            <p>Les utilisateurs peuvent s'inscrire via Google ou Apple (OAuth 2.0) ou manuellement avec prénom, nom, email, téléphone, adresse et mot de passe. Les utilisateurs doivent avoir 16 ans minimum. Les moins de 16 ans doivent fournir un consentement parental explicite à dpo@goglow.com. Les utilisateurs sont responsables de la confidentialité de leurs identifiants et de toute activité de leur compte.</p>
                            
                            <h4>4. Objet et Utilisation du Service</h4>
                            <p>L'application facilite la découverte, la réservation et la communication entre salons et clients. Elle n'est pas destinée à la promotion non sollicitée ni à un annuaire public sans consentement. GoGlow agit uniquement comme intermédiaire technique et n'est pas responsable de l'exécution ou de la qualité des services.</p>
                            
                            <h4>5. Paiements et Acompte</h4>
                            <p>Un acompte de 15 % est facturé lors de la réservation via Stripe (conforme PCI-DSS). Les informations de carte ne sont pas stockées. Les remboursements sont gérés entre le client et le prestataire selon la politique de ce dernier. GoGlow peut percevoir une commission pour les services de la plateforme.</p>
                            
                            <h4>6. Accès à la Localisation</h4>
                            <p>GoGlow demande l'accès à la localisation uniquement pour afficher les salons à proximité via l'API Google Maps. Les prestataires peuvent épingler l'adresse de leur salon. Les données de localisation ne sont pas conservées au-delà de cet usage et sont retenues 2 mois maximum.</p>
                            
                            <h4>7. Communication</h4>
                            <p>L'application permet une messagerie chiffrée entre clients et prestataires après réservation. Les numéros de téléphone ne sont partagés qu'après confirmation de réservation ou consentement explicite.</p>
                            
                            <h4>8. Notifications</h4>
                            <p>Des notifications push sont utilisées pour les réservations, les messages et les mises à jour. Les utilisateurs peuvent désactiver ces notifications dans les paramètres de leur appareil.</p>
                            
                            <h4>9. Utilisation Acceptable</h4>
                            <p>Les utilisateurs ne doivent pas :</p>
                            <ul>
                                <li>Se livrer à des activités abusives, harcelantes ou illégales</li>
                                <li>Publier du contenu offensant ou discriminatoire</li>
                                <li>Tenter d'accéder ou de modifier les services de l'application sans autorisation</li>
                                <li>Télécharger du contenu malveillant ou enfreindre la propriété intellectuelle</li>
                            </ul>
                            
                            <h4>10. Contenu et Propriété Intellectuelle</h4>
                            <p>Les utilisateurs peuvent publier des avis ou des photos et accordent à GoGlow une licence non exclusive et mondiale pour les afficher. Tous les éléments de l'application (textes, codes, marques) sont protégés par la propriété intellectuelle.</p>
                            
                            <h4>11. Suspension et Suppression de Compte</h4>
                            <p>GoGlow peut suspendre ou résilier des comptes en cas de violation des règles ou de comportement inapproprié. Les sanctions peuvent inclure avertissement, suspension temporaire ou suppression définitive. Les utilisateurs peuvent supprimer leur compte à tout moment ; toutes les données sont définitivement supprimées sous 30 jours.</p>
                            {{-- /////////////////// --}}
                            <h4>12. User-Generated Content</h4>
                            <p>Our Service may allow you to post, link, store, share, and otherwise make available certain information, text, graphics, videos, or other material ("Content"). You are responsible for the Content that you post on or through the Service, including its legality, reliability, and appropriateness.</p>
                            
                            <h4>13. Prohibited Content and Activities</h4>
                            <p>You agree not to post any content that is illegal, harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, sexually explicit, profane, hateful, or racially, ethnically, or otherwise objectionable. This includes, but is not limited to, content that promotes discrimination, bigotry, racism, hatred, harassment, or harm against any individual or group.
You agree not to engage in any abusive behavior towards other users. Abusive behavior includes, but is not limited to, harassment, bullying, and spamming.</p>
                            
                            <h4>14. Content Moderation</h4>
                            <p>We have no obligation to, but reserve the right to, monitor, filter, and remove any content that violates these terms. We also reserve the right to terminate or suspend your account for posting objectionable content or for abusive behavior.
We will act on reports of objectionable content within 24 hours by removing the content and ejecting the user who provided the offending content.</p>
                            {{-- /////////////////// --}}

                            <h4>15. Intégration Instagram / Meta – Prestataires (Glowers)</h4>
                            <p>Les Prestataires peuvent connecter leur compte Instagram professionnel à l'application Glaura afin d'afficher automatiquement certains contenus sur leur profil Glaura.</p>
                            
                            <h5>Conditions de connexion</h5>
                            <p>En connectant leur compte Instagram, les Prestataires :</p>
                            <ul>
                                <li>autorisent Glaura à accéder à leurs contenus publics via les API officielles de Meta</li>
                                <li>confirment disposer des droits nécessaires sur les contenus publiés</li>
                                <li>acceptent que seules les publications contenant le hashtag #glaura puissent être affichées</li>
                            </ul>
                            <p>Glaura ne publie aucun contenu sur Instagram au nom du Prestataire.</p>
                            
                            <h4>16. Responsabilité du Contenu Importé (Instagram)</h4>
                            <p>Le Prestataire reste seul responsable :</p>
                            <ul>
                                <li>du contenu publié sur Instagram</li>
                                <li>de sa légalité, exactitude et conformité</li>
                                <li>du respect des droits d'auteur, droits à l'image et règles Meta</li>
                            </ul>
                            <p>Glaura agit uniquement comme intermédiaire technique et ne saurait être tenue responsable du contenu importé depuis Instagram.</p>
                            
                            <h4>17. Suppression et Retrait des Contenus (Instagram)</h4>
                            <ul>
                                <li>Le Prestataire peut retirer l'accès Instagram à tout moment</li>
                                <li>La suppression d'un post sur Instagram entraîne sa suppression sur Glaura</li>
                                <li>Glaura se réserve le droit de retirer tout contenu jugé :
                                    <ul>
                                        <li>illégal</li>
                                        <li>trompeur</li>
                                        <li>offensant</li>
                                        <li>non conforme aux présentes CGU ou aux règles Meta</li>
                                    </ul>
                                </li>
                            </ul>
                            
                            <h4>18. Suspension liée aux Réseaux Sociaux</h4>
                            <p>Glaura peut suspendre l'intégration Instagram ou le compte Prestataire en cas :</p>
                            <ul>
                                <li>d'abus de hashtags</li>
                                <li>de contenu frauduleux ou trompeur</li>
                                <li>de violation des politiques Meta</li>
                                <li>de signalements répétés</li>
                            </ul>

                            <h4>19. Obligations des Prestataires</h4>
                            <p>Les Glowers doivent fournir des informations exactes et à jour, honorer les réservations acceptées et respecter la législation sur la protection des consommateurs.</p>
                            
                            <h4>20. Responsabilité</h4>
                            <p>GoGlow décline toute responsabilité concernant l'exécution des prestations, le contenu généré par les utilisateurs ou les liens externes. L'application est fournie « en l'état » sans garantie.</p>
                            
                            <h4>21. Liens Externes</h4>
                            <p>Des liens externes peuvent être présents à titre informatif. GoGlow n'est pas responsable de leur contenu ni de leurs pratiques.</p>
                            
                            <h4>22. Droit Applicable</h4>
                            <p>Les présentes CGU sont régies par le droit français. Tout litige relève de la compétence exclusive des tribunaux de Paris.</p>
                            
                            <h4>23. Contact</h4>
                            <p>Pour toute question : <a href="mailto:contact@goglow.com">contact@goglow.com</a></p>
                        </div>
                    </div>
                    <!-- Terms Content End -->
                </div>               
            </div>
        </div>
    </div>
    <!-- Terms and Conditions Section End -->

@endsection


{{-- Scripts --}}
@section('scripts')


@endsection
