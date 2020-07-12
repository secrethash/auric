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
            2 => 
            array (
                'id' => 3,
                'slug' => 'support',
                'title' => 'Support',
                'body' => '<!-- Settings Wrapper-->

<div class="settings-wrapper py-3">
<h4 class="mb-3">Contact Us</h4>
<div class="card settings-card">
<div class="card-body">
<!-- Single Settings-->
<div class="single-settings d-flex align-items-center justify-content-between">
<div class="title"><i class="lni-question-circle"></i><span>Email Address</span></div>
<div class="data-content"><a href="mailto:care@auricshops.com" class="stretched-link">care@auricshops.com<i class="lni-chevron-right"></i></a></div>
</div>
</div>
</div>
<div class="card settings-card">
<div class="card-body">
<!-- Single Settings-->
<div class="single-settings d-flex align-items-center justify-content-between">
<div class="title"><i class="lni-alarm-clock"></i><span>After Sale Hours</span></div>
<div class="data-content">10 AM - 5 PM (Monday to Friday)<i class="lni-chevron-right"></i></div>
</div>
</div>
</div>

<p class="mt-3 mb-3 font-weight-bolder text-center">If you can’t get our reply, please wait patiently.</p>

</div>',
                'layout' => NULL,
                'page_title' => 'Support & Complaints',
                'blade' => 0,
                'created_at' => '2020-07-12 20:17:00',
                'updated_at' => '2020-07-12 21:10:33',
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'risk-disclosure',
                'title' => 'Risk & Disclosure Agreement',
                'body' => '<div class="privacy-policy-wrapper py-3">
<div class="clearfix">
<h4>Chapter 1: Risk Disclosure Agreement</h4>
<p>
Booking/Collection Description Prepayment Booking/Recycling Customer should read and understand the business content carefully before making prepayment bookings (prepayment lock price, payment settlement and shipment) /recovery or repurchase (prepayment lock price, shipping payment) before making prepayment bookings to Auric-shops:
<ol>
<li>Before making an appointment/restoring the prepayment business, the customer should complete the real name authentication in the mall and ensure that the name, ID number, bank account number, delivery address and other information filled in are true, accurate and valid; Otherwise, the user will be liable for the consequences of false information.</li>
<li>Customers can order gold and silver products in advance at the shopping centre. Orders can be cancelled by 01:30 a.m. on the same Saturday. When the customer pays the end payment, the mall receives the final payment and arranges the delivery. If the customer does not pay the final pick-up by 01:30 a.m. on Saturday, the customer is deemed to have made the last offer before the inventory and the booking is cancelled.</li>
<li>Customers can make an appointment to recycle gold and silver products purchased at the gold point. Pre-purchase recovery requires a credit margin and confirmation of actual possession of gold and silver products purchased from the mall. Customers can cancel their reservation at any time before 01:30 on Saturday and the credit mark will be refunded after deducting the increase or decrease in the value of the goods within the corresponding time. If the customer fails to deliver the goods to a shopping mall or shopping center at the designated collection point by Saturday within the same week, or if the goods delivered do not meet the recycling standard test, the customer will be deemed to have cancelled the reservation recovery and will bear the logistics and testing costs.</li>
<li>Counting time: Daily 01:30-05:30 for the mall warehouse inventory time. During the inventory period, the mall stops accepting advance payments for reservations/receipts.</li>
<li>For further details, please refer to the Business Guidelines in the front page of the mall, Understanding Auric shops.</li>
</ol>
</p>
</div>
<div class="clearfix">
<h4>Chapter 2: Reveals the business model of Auric-shops</h4>
<p>
Booking/repurchase orders, the business model for clearing balance shipments, uncertainties such as potential benefits and potential risks to the value of its merchandise due to real-time fluctuations in the gold and silver market, and the extent to which booking/repo risk stake is understood for customer booking/repo risk, Risk control ability and understanding of related products have high requirements. Customer selects prepayment booking/repurchase, fully informed on behalf of the customer and understand the risks of prepayments/repurchase business and agree to and accept Auric-shops current and future relevant booking/repurchase business processes and management systems (collectively, the Process Systems) to develop, modify and publish. This Risk Disclosure (Disclosure) is intended to fully disclose to the Client the risk of the prepayment booking/repurchase business and is intended only to provide reference for the client to assess and determine its own risk tolerance. The risk disclosures described in this disclosure are for example only. All risk factors associated with Auric shops Advance Booking/Repurchase are not detailed. Customers should also carefully understand and understand other possible risk factors before starting or participating in Auric-shops prepayment booking/repurchase business. If the customer is not aware of or is not aware of this disclosure, they should consult Auric-shops Customer Service or the relevant regional service provider in a timely manner. If the Customer ultimately clicks on Risk Disclosure, it is deemed that the Customer fully agrees and accepts the full contents of this disclosure.
</p>
<h5>Warm tips</h5>
<p>
<ol>
<li>Minors under the age of 18 are not permitted to participate in The Auric-shops Advance Booking/Recycling. 2.Auric-shops Advance Booking/Repo is only available to customers who meet all of the following criteria: 1 Natural persons with full civil capacity, legal persons of enterprises or other economic organizations registered in accordance with the law.</li>
<li>To fully understand all risks associated with Auric shops Advance Booking/Repurchase business and have a certain risk tolerance.</li>
<li>Have a certain understanding of gold and silver and its products:
<li>Policy-related risk disclosure, such as changes in national laws, regulations and policies, contingency measures, implementation of appropriate regulatory measures, Auric-shops regulatory system and changes in management methods and regulations, etc., all risks that may affect customer bookings/repurchases, etc., the customer must bear the losses incurred.</li>
<li>Price fluctuations, gold, silver and other precious metals and their accessories are affected by a variety of factors, such as the international economic situation, foreign exchange, related market trends, supply and demand, and political situation and energy prices. The pricing mechanism for gold, silver and other precious metals products is very complex, making it difficult for customers to fully grasp in practice, so decisions such as advance booking/buyback are possible Mistakes, if the risk cannot be effectively controlled, may suffer losses and the customer must bear all the losses incurred as a result.</li>
</li>
<li>Auric-shops has enabled the provision of services through electronic communication technology and Internet technology. Communication services and hardware and software services are provided by different vendors and may be at risk in terms of quality and stability. Interruptions or delays due to communication or network failures may affect customer prepayment bookings/repurchases. In addition, the customer\'s computer system may be attacked by viruses and/or cyber-hackers, resulting in the customers advance payment booking/repurchase not being properly and/or timely.<br/>
There is also a risk that the above uncertainties may affect the customer’s advance payment booking/repurchase.
<li>The price quoted by the Auric-shops Prepayment Booking/Repo System is based on the system\'s real-time trading price and may differ slightly from the commodity prices in other markets. Auric-shops cannot guarantee that the above prepayment booking//repurchase price is fully consistent with other markets.</li>
<li>At Auric-shops; once the customer\'s prepayment booking/repurchase application submitted through the online terminal is completed, it cannot be withdrawn and the customer must accept the risks associated with such a subscription.</li>
<li>Auric-shops prohibits regional service providers and their staff from providing any profit guarantee to customers, from engaging in prepaid bookings/repurchases on behalf of customers, or from sharing profits or risks with customers. Customers should be aware that any profit guarantee or commitment that Auric-shops advance booking/repurchase does not have a loss, profit share or risk-sharing is impossible, unfounded, and incorrect.</li>
<li>The customers pre-paid booking / repurchase application must be based on the customers own decision. Auric-shops and regional service providers and employees do not provide booking / buyback to the client, nor does it constitute any commitment if the client makes a booking / buyback decision accordingly.</li>
<li>In the advance booking / buyback process, there may be occasional apparent errors in the offer.</li>
</li>
<li><strong>RISK-AGREEMENT</strong> Typhoons, floods, fires, wars, disturbances, rule revisions, changes or adjustments in government regulatory policies and regulatory requirements, and electricity, To ensure that you fully understand the relevant provisions and risks of booking / repurchase business, customers should be based on their own booking experience, booking / repurchase / purchase of commodities, read all the contents of the advance booking / repurchase notice carefully, and fully understand and agree to all the contents, I am willing to take all risks to start or participate in Auric-shops. In the case of the above mentioned condition I shall be him-self liable to any financial as well as monetary loss. By accepting this I shall be no more eligible to claim any statutory legal benefits given to Indian citizens by Law of India.</li>
</ol>
<blockquote><strong>Note:</strong> I have carefully read all contents of this app including Privacy Statement, Risk Disclosure Agreement and Risk Agreement and I am agreed to continue with my own risk.</blockquote>
</p>
</div>
<div class="clearfix">
<h4>Chapter 3: Cancellation and Refund Policy</h4>
<p>In case of any discrepancy we can cancel any of the orders placed by you. A few reasons for cancellation from our end usually include limitation of the product in the inventory, error in pricing, error in product information etc. We also have the right to check out for extra information for the purpose of accepting orders in a few cases. We make sure to notify you if your order is cancelled partially or completely or if in case any extra data is required for the purpose of accepting your order.</p>
<p>Once you place the order, such order can be cancelled from your end before the shipping is undertaken to the destination. Once the request for cancellation for a ready for shipping product is received by us, we make sure to refund the amount through the same mode of payment within 5 working days. Cancellation of the order of Gold coin(exchanged by integrals) shall not be accepted as under Company’s policies.</p>
<p>We don’t accept Cancellation requests for Smart Buy orders or customized jewellery orders. In specific situations when the customer wants the money back or wants to exchange it with other products, making charges of the product and stone charges, if there is any stone on the product shall be deducted from the payment and balance will be refunded back to the customer account within 5 working days.</p>
<p>If in case the amount is deducted from your account and the transaction has failed, the same will be refunded back to your account within 72 hours.</p>
</div>
</div>',
                'layout' => NULL,
                'page_title' => 'Risk & Disclosure Agreement',
                'blade' => 0,
                'created_at' => '2020-07-12 20:35:00',
                'updated_at' => '2020-07-12 20:54:29',
            ),
            4 => 
            array (
                'id' => 5,
                'slug' => 'about-us',
                'title' => 'About Us',
                'body' => '<div class="privacy-policy-wrapper py-3">
<h4>Company Introduction</h4>
<p>Auric Shops is an online mall business that engages in full payment and prepayment booking/unsubscription business according to the rules and conditions that we have established to regulate the business. We have tie-up with some other reputed companies to provide best and satisfactory services to our clients/customers. Our company is one of the best among to follow laws and we have certain restrictions to prevent online fraud with our clients we do not allow. Minors under the age of 18 are not permitted to participate in The Auric-Shops Advance Booking/unsubscribing.</p>
<p><strong>Note:</strong> Being responsible traders we advise our client to readout our Privacy Statement, Risk Disclosure Agreement and Risk Agreement carefully to minimize their risk.</p>
</div>

<div class="settings-wrapper py-3">
<h4 class="mb-3">Contact Us</h4>
<div class="card settings-card">
<div class="card-body">
<!-- Single Settings-->
<div class="single-settings d-flex align-items-center justify-content-between">
<div class="title"><i class="lni-question-circle"></i><span>Email Address</span></div>
<div class="data-content"><a href="mailto:care@auricshops.com" class="stretched-link">care@auricshops.com<i class="lni-chevron-right"></i></a></div>
</div>
</div>
</div>
<div class="card settings-card">
<div class="card-body">
<!-- Single Settings-->
<div class="single-settings d-flex align-items-center justify-content-between">
<div class="title"><i class="lni-alarm-clock"></i><span>After Sale Hours</span></div>
<div class="data-content">10 AM - 5 PM (Monday to Friday)<i class="lni-chevron-right"></i></div>
</div>
</div>
</div>

<p class="mt-3 mb-3 font-weight-bolder text-center">If you can’t get our reply, please wait patiently.</p>

</div>',
                'layout' => NULL,
                'page_title' => 'About Us',
                'blade' => 0,
                'created_at' => '2020-07-12 20:59:00',
                'updated_at' => '2020-07-12 21:09:04',
            ),
        ));
        
        
    }
}