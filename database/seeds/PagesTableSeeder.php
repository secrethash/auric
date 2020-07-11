<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'my-offers',
                'title' => 'My Offers',
                'body' => '<div class="privacy-policy-wrapper py-3">
<h6>Grab Exciting Offers</h6>
<p class="m-2 pl-2">
<ol>
<li>Earn credits worth 10% on adding ₹1,000 to your wallet</li>
<li>Earn credits worth 15% on adding ₹5,000 to your wallet</li>
<li>Earn credits worth 20% on adding ₹10,000 to your wallet</li>
</ol>
</p>
</div>',
                'layout' => NULL,
                'page_title' => 'My Offers',
                'blade' => 0,
                'created_at' => '2020-07-11 22:50:00',
                'updated_at' => '2020-07-11 23:04:39',
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'body' => '<div class="privacy-policy-wrapper py-3">
<h5 class="text-center">Privacy Policy</h5>
<p>We know that you trust www.auricshops.com. We respect the privacy of our users and the confidentiality of the information provided by you when using the Website. Accordingly, we have developed this Privacy Policy to demonstrate our commitment to protecting the same. This Privacy Policy describes the type of information we collect, purpose, usage, storage and handling of such information, and disclosure thereof. We encourage you to read this PrivacyPolicy very carefully when (i) accessing the Website, and/or (ii) availing any products offered onor through the Website, from any computer, computer device or mobile.By using the Website, you hereby expressly acknowledge, agree and accept the practices described in this Privacy Policy and agree to be bound by the terms and conditions thereof. If You do not agree, please do not use or access the Website. This Privacy Policy is incorporated into and is subject to our Terms of Use available at the link.</p>

<h6 class="text-center">PERSONAL INFORMATION THAT ARE COLLECTED</h6>
<p>
<ol class="py-3 my-2">
<li>When you use the Website, we collect, store and share your personal and non-personal information which is provided by you from time to time. This allows us to provide you with products, services, offers and features for a customized and personalized Website experience.</li>
<li>Your personal information helps us to collect information that can directly identify you such as your name, surname, email address, phone number, credit card/debit card and other payment instrument details. We also collect your non-personal information that does not directly identify you. By entering into the Website, you are authorizing us to collect, parse, process, disclose,disseminate and retain such information and making this available to other users and/or third parties but only as envisaged herein.</li>
<li>We may offer you a facility to browse the Website on an anonymous basis without revealing your personal information. However, once you provide us your personal information,you shall no longer be anonymous.</li>
<li>In certain areas of the Website, we shall indicate which fields are mandatory and which are optional. You always have the option not to provide information in the optional fields. You may also be provided with a facility not to avail any particular service or feature on the Website.</li>
<li>We may use your contact information to send you an offer from time to time or to provide you with any information about any products or services or any new feature of the Website.</li>
</ol>
</p>
<h6 class="text-center">USE OF INFORMATION</h6>
<p>We may use information that we collect from you to:
<ol>
<li>Verify your eligibility;</li>
<li>Deliver and improve the products / services offered through the Website;</li>
<li>Manage your account and provide you with customer support;</li>
<li>Perform research and analysis about your use of, or interest in, products, services, features offered on the Website;</li>
<li>Communicate with you by email, postal mail, telephone and/or mobile devices about products or services that may be of interest to you or ordered by you from the Website;</li>
<li>Develop, display, and track content and advertising tailored to your interests;</li>
<li>Provide you with a customized / personalized Website user experience;</li>
<li>Perform functions or services as otherwise described to you at the time of collection;</li>
<li>To resolve disputes and troubleshoot problems, if any;</li>
<li>To collect payment towards any products/services availed by you;</li>
<li>Inform you about any offers, products, services, features and/or updates;</li>
<li>Enforce or exercise any rights in our Terms of Use; and</li>
<li>Generally to undertake and manage our business.</li>
</ol>
</p>
<h6 class="text-center">SECURITY PRECAUTIONS</h6>
<p>We adopt reasonable security practices and procedures to help safeguard your personal information under our control from unauthorized access. However, you acknowledge that noInternet transmission or system or server can be 100% secure. Therefore, although we take all reasonable steps to secure your personal information, we do not promise or guarantee the same, and you should not expect that your personal information, chats, or other communications while using the Website will always remain secure and safeguarded by us. You Should always exercise caution while providing, sharing or disclosing your personal information using the Website. We request you to take steps to keep your personal information safe and to always log out of the Website after use. You are solely liable and responsible for any information you provide and/or share using the Website.</p>
<h6 class="text-center">CHOICE/OPT-OUT</h6>
<p>We provide all the users with a chance of opting out of promotional and marketing related services from us on behalf of our partners, after you set up an account by clicking UNSUBSCRIBE to such emails.</p>
<h6 class="text-center">CHANGES TO THE PRIVACY POLICY</h6>
<p>Our Privacy Policy is subject to change at any time without notice. When we post changes to this Privacy Policy, we will revise the "last updated" date. We recommend that you check the Website from time to time to keep yourself updated of any changes in this Privacy Policy or any of our other Website policies.</p>
</div>',
                'layout' => NULL,
                'page_title' => 'Privacy Policy',
                'blade' => 0,
                'created_at' => '2020-07-11 23:30:00',
                'updated_at' => '2020-07-11 23:37:23',
            ),
        ));
        
        
    }
}