<?php

/**
 * Class Give_Billplz_Settings
 *
 * @since 3.0
 */
class Give_Billplz_Settings
{

    /**
     * @access private
     * @var Give_Billplz_Settings $instance
     */
    static private $instance;

    /**
     * @access private
     * @var string $section_id
     */
    private $section_id;

    /**
     * @access private
     *
     * @var string $section_label
     */
    private $section_label;

    /**
     * Give_Billplz_Settings constructor.
     */
    private function __construct()
    {
        
    }

    /**
     * get class object.
     *
     * @return Give_Billplz_Settings
     */
    static function get_instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Setup hooks.
     */
    public function setup_hooks()
    {

        $this->section_id = 'billplz';
        $this->section_label = __('Billplz', 'give-billplz');


        if (is_admin()) {
            // Add settings.
            add_filter('give_settings_gateways', array($this, 'add_settings'), 99);
        }
    }

    /**
     * Add setting section.
     *
     * @param array $sections Array of section.
     *
     * @return array
     */
    public function add_section($sections)
    {
        $sections[$this->section_id] = $this->section_label;

        return $sections;
    }

    /**
     * Add plugin settings.
     *
     * @param array $settings Array of setting fields.
     *
     * @return array
     */
    public function add_settings($settings)
    {

        $give_billplz_settings = array(
            array(
                'name' => __('Billplz Settings', 'give-billplz'),
                'id' => 'give_title_billplz',
                'type' => 'give_title',
            ),
            array(
                'name' => __('API Secret Key', 'give-billplz'),
                'desc' => __('Enter your API Secret Key, found in your Billplz Account Settings.', 'give-billplz'),
                'id' => 'billplz_api_key',
                'type' => 'text',
                'row_classes' => 'give-billplz-key',
            ),
            array(
                'name' => __('X Signature Key', 'give-billplz'),
                'desc' => __('Enter your X Signature Key, found in your Billplz Account Settings.', 'give-billplz'),
                'id' => 'billplz_x_signature_key',
                'type' => 'text',
                'row_classes' => 'give-billplz-key',
            ),
            array(
                'name' => __('Collection ID', 'give-billplz'),
                'desc' => __('Enter your Collection ID. If you unsure, just leave blank.', 'give-billplz'),
                'id' => 'billplz_collection_id',
                'type' => 'text',
                'row_classes' => 'give-billplz-key',
            ),
            array(
                'name' => __('Bills Description', 'give-billplz'),
                'desc' => __('Enter your Bills Description.', 'give-billplz'),
                'id' => 'billplz_bills_description',
                'type' => 'text',
                'row_classes' => 'give-billplz-key',
            ),
            array(
                'name' => __('Delivery Notification', 'give-billplz'),
                'desc' => __('Enabling this option will enable the Bills to be sent to the Donator.', 'give-billplz'),
                'id' => 'billplz_delivery_notifcation',
                'type' => 'checkbox',
            ),
            array(
                'name' => __('Collect Billing Details', 'give-billplz'),
                'desc' => __('This option will enable the billing details section for Billplz which requires the donor\'s address to complete the donation. These fields are not required by Billplz to process the transaction, but you may have the need to collect the data.', 'give-billplz'),
                'id' => 'billplz_collect_billing',
                'type' => 'checkbox',
            ),
            array(
                'name' => __('Checkout Heading', 'give-billplz'),
                'desc' => __('This is the main heading within the modal checkout. Typically, this is the name of your organization, cause, or website.', 'give-billplz'),
                'id' => 'billplz_checkout_name',
                'row_classes' => 'billplz-checkout-field',
                'default' => get_bloginfo('name'),
                'type' => 'text',
            ),
            array(
                'name' => __('Processing Text', 'give-billplz'),
                'desc' => __('This text appears briefly after the donor has made a successful donation while Give is confirming the payment with the Billplz API.', 'give-billplz'),
                'id' => 'billplz_checkout_processing_text',
                'row_classes' => 'billplz-checkout-field',
                'default' => __('Donation Processing...', 'give-billplz'),
                'type' => 'text',
            ),
            array(
                'name' => __('Remember Me', 'give-billplz'),
                'desc' => __('Specify whether to include the option to "Remember Me" for future donations.', 'give-billplz'),
                'id' => 'billplz_checkout_remember_me',
                'row_classes' => 'billplz-checkout-field',
                'default' => 'on',
                'type' => 'checkbox',
            ),
        );

        return array_merge($settings, $give_billplz_settings);
    }
}

Give_Billplz_Settings::get_instance()->setup_hooks();
