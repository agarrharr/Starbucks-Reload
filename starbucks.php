<?php
/*
Plugin Name: Starbucks Reload
Plugin URI: http://www.adamwadeharris.com/starbucks-reload-widget/
Description: This plugin allows you to put a widget on your site that allows visitors to reload your Starbucks card.
Author: Adam Harris
Author URI: http://www.adamwadeharris.com
Version: 1.2
Author URI: http://www.adamwadeharris.com

Copyright 2012 Adam Harris

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class starbucksWidget extends WP_Widget{
	function starbucksWidget(){
		$widget_options = array(
			'classname' => 'starbucks-widget',
			'description' => 'Let visitors reload your Starbucks card.'
		);
		parent::WP_Widget('starbucks-widget', 'Starbucks Widget', $widget_options);
	}
	
	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$title = ($instance['title'])? $instance['title']: 'Buy Me Coffee';
		$message = ($instance['message'])? $instance['message']: 'If you found value in this site, feel free to reload my Starbucks card to say thanks.';
		$cardNumber = ($instance['cardNumber'])? $instance['cardNumber']: '6069262396927591';
		?>
		<li id="starbucksWidget" class="widget widget_starbuck">
        <h1 class="widget-title"><?php echo $title; ?></h1>
        <p><?php echo $message; ?></p>
		<br/>
		<form action="https://www.starbucks.com/card/reload/one-time" class="AjaxForm required_form payment-method region size2of3" id="OneTimeReload" method="post" novalidate="novalidate" target="_blank">
				<input class="field_large numbers card-number required numeric" id="Card_Number" maxlength="16" name="Card.Number" title="Card Number | This 15- or 16-digit number is on the front of your card. Please enter it without spaces." type="hidden" value="<?php echo $cardNumber; ?>">
				<span class="numbers">$</span>
				<input class="field_xxsmall align_right numbers" data-validation-max="100" data-validation-min="10" id="Reload_Amount" maxlength="3" name="Reload.Amount" title="Please enter an amount." type="text" value="10">
			<input id="paymentOptionHidden" name="paymentOptionHidden" type="hidden" value="CreditCard">
			<br/>
			<label for="card-type-paypal">
				<input class="credit-card radio" id="card-type-paypal" name="paymentOption" type="radio" value="PayPal">
				PayPal
			</label>
			<br/>
			<label for="card-type-options">
				<input checked="checked" class="credit-card radio" id="card-type-options" name="paymentOption" type="radio" value="CreditCard">
				Credit/Debit Card
			</label>
			
			<input type="hidden" name="step" value="1">
			<br/>
			<button type="submit"><?php echo $title; ?></button>
		</form>
		</li>
		<?php
	}
	
	function form($instance){
		?>
		<label for="<?php echo $this->get_field_id('title'); ?>">
		Title:
        <br/>
		<input id="<?php echo $this->get_field_id('title'); ?>"
			name="<?php echo $this->get_field_name('title'); ?>"
			value="<?php echo esc_attr($instance['title']); ?>" />
		</label>
        <br/>
		<label for="<?php echo $this->get_field_id('message'); ?>">
		Message:
        <br/>
		<textarea id="<?php echo $this->get_field_id('message'); ?>"
			name="<?php echo $this->get_field_name('message'); ?>"><?php echo esc_attr($instance['message']); ?></textarea>
		</label>
        <br/>
		<label for="<?php echo $this->get_field_id('cardNumber'); ?>">
		Starbucks Card Number:
        <br/>
		<input id="<?php echo $this->get_field_id('cardNumber'); ?>"
			name="<?php echo $this->get_field_name('cardNumber'); ?>"
			value="<?php echo esc_attr($instance['cardNumber']); ?>" />
		</label>
		<?php
	}
}

function starbucks_widget_init(){
	register_widget("starbucksWidget");
}
add_action('widgets_init', 'starbucks_widget_init');
?>