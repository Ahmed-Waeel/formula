<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = array(
            ['key' => 'pdf_ar_logo', 'value' => 'ar_logo.png'],
            ['key' => 'pdf_en_logo', 'value' => 'en_logo.png'],
            ['key' => 'pdf_website_url', 'value' => ''],
            ['key' => 'pdf_linkedin', 'value' => ''],
            ['key' => 'pdf_facebook', 'value' => ''],
            ['key' => 'pdf_instagram', 'value' => ''],
            ['key' => 'pdf_snapchat', 'value' => ''],
            ['key' => 'pdf_twitter', 'value' => ''],

            /* English PDF Settings */
            ['key' => 'en_title', 'value' => 'Price Offer'],

            /* English PDF Hotels Table */
            ['key' => 'en_pdf_hotels', 'value' => 'Hotels'],
            ['key' => 'en_pdf_hotels_1', 'value' => 'Day'],
            ['key' => 'en_pdf_hotels_2', 'value' => 'Date'],
            ['key' => 'en_pdf_hotels_3', 'value' => 'Start Date <br> - <br> End Date'],
            ['key' => 'en_pdf_hotels_4', 'value' => 'Notes'],

            /* English PDF International Flights Table */
            ['key' => 'en_pdf_international_flights', 'value' => 'International Flights'],
            ['key' => 'en_pdf_international_flights_1', 'value' => 'Day'],
            ['key' => 'en_pdf_international_flights_2', 'value' => 'Date'],
            ['key' => 'en_pdf_international_flights_3', 'value' => 'Description'],
            ['key' => 'en_pdf_international_flights_4', 'value' => 'Notes'],

            /* English PDF Internal Flights Table */
            ['key' => 'en_pdf_internal_flights', 'value' => 'Internal Flights'],
            ['key' => 'en_pdf_internal_flights_1', 'value' => 'Day'],
            ['key' => 'en_pdf_internal_flights_2', 'value' => 'Date'],
            ['key' => 'en_pdf_internal_flights_3', 'value' => 'Description'],
            ['key' => 'en_pdf_internal_flights_4', 'value' => 'Notes'],

            /* English PDF Transporatations Table */
            ['key' => 'en_pdf_transportations', 'value' => 'Transportations'],
            ['key' => 'en_pdf_transportations_1', 'value' => 'Day'],
            ['key' => 'en_pdf_transportations_2', 'value' => 'Date'],
            ['key' => 'en_pdf_transportations_3', 'value' => 'Description'],
            ['key' => 'en_pdf_transportations_4', 'value' => 'Notes'],

            /* English PDF Hotels Activities */
            ['key' => 'en_pdf_activities', 'value' => 'Activities'],
            ['key' => 'en_pdf_activities_1', 'value' => 'Day'],
            ['key' => 'en_pdf_activities_2', 'value' => 'Date'],
            ['key' => 'en_pdf_activities_3', 'value' => 'Image'],
            ['key' => 'en_pdf_activities_4', 'value' => 'Description'],
            ['key' => 'en_pdf_activities_5', 'value' => 'Notes'],

            ['key' => 'en_international_flights_cost', 'value' => 'International Flights Cost'],
            ['key' => 'en_notes', 'value' => 'Very Important Notes'],
            ['key' => 'en_price', 'value' => 'Total Price'],
            ['key' => 'en_deposite', 'value' => 'To confirm the reservation, please transfer the deposit value as an advance payment of the total cost '],


            /*Arabic PDF Settings*/
            ['key' => 'ar_title', 'value' => 'عرض سعر'],

            /* Arabic PDF Hotels Table */
            ['key' => 'ar_pdf_hotels', 'value' => 'الفنادق'],
            ['key' => 'ar_pdf_hotels_1', 'value' => 'اليوم'],
            ['key' => 'ar_pdf_hotels_2', 'value' => 'تاريخ البداية  <br> - <br> تاريخ النهاية'],
            ['key' => 'ar_pdf_hotels_3', 'value' => 'الوصف'],
            ['key' => 'ar_pdf_hotels_4', 'value' => 'الملاحظات'],

            /* Arabic PDF International Flights Table */
            ['key' => 'ar_pdf_international_flights', 'value' => 'الطيران الدولى'],
            ['key' => 'ar_pdf_international_flights_1', 'value' => 'اليوم'],
            ['key' => 'ar_pdf_international_flights_2', 'value' => 'التاريخ'],
            ['key' => 'ar_pdf_international_flights_3', 'value' => 'الوصف'],
            ['key' => 'ar_pdf_international_flights_4', 'value' => 'الملاحظات'],

            /* Arabic PDF Internal Flights Table */
            ['key' => 'ar_pdf_internal_flights', 'value' => 'الطيران الداخلي'],
            ['key' => 'ar_pdf_internal_flights_1', 'value' => 'اليوم'],
            ['key' => 'ar_pdf_internal_flights_2', 'value' => 'التاريخ'],
            ['key' => 'ar_pdf_internal_flights_3', 'value' => 'الوصف'],
            ['key' => 'ar_pdf_internal_flights_4', 'value' => 'الملاحظات'],

            /* Arabic PDF Transporatations Table */
            ['key' => 'ar_pdf_transportations', 'value' => 'المواصلات'],
            ['key' => 'ar_pdf_transportations_1', 'value' => 'اليوم'],
            ['key' => 'ar_pdf_transportations_2', 'value' => 'التاريخ'],
            ['key' => 'ar_pdf_transportations_3', 'value' => 'الوصف'],
            ['key' => 'ar_pdf_transportations_4', 'value' => 'الملاحظات'],

            /* Arabic PDF Hotels Activities */
            ['key' => 'ar_pdf_activities', 'value' => 'الأنشطة'],
            ['key' => 'ar_pdf_activities_1', 'value' => 'اليوم'],
            ['key' => 'ar_pdf_activities_2', 'value' => 'التاريخ'],
            ['key' => 'ar_pdf_activities_3', 'value' => 'Image'],
            ['key' => 'ar_pdf_activities_4', 'value' => 'الوصف'],
            ['key' => 'ar_pdf_activities_5', 'value' => 'الملاحظات'],

            ['key' => 'ar_international_flights_cost', 'value' => 'سعر الطيران الدولي'],
            ['key' => 'ar_notes', 'value' => 'ملاحظات مهمة جدا'],
            ['key' => 'ar_price', 'value' => 'السعر الإجمالي'],
            ['key' => 'ar_deposite', 'value' => 'ولتأكيد الحجز يرجي تحويل قيمة العربون كدفعة مقدمة من التكلفة الإجمالية وتساوي '],
        );

        Setting::insert($admins);
    }
}
