<?php

use emreuyguc\EasyTag\HtmlTag;

require_once '../vendor/autoload.php';

echo HtmlTag::html(
	HtmlTag::head(
		HtmlTag::meta(['charset' => 'utf-8']),
		HtmlTag::meta(['author' => 'EMRE UYGUÇ']),
		HtmlTag::link(['rel' => 'stylesheet','href'=>'https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css']),
		HtmlTag::link(['rel' => 'stylesheet','href'=>'https://getbootstrap.com/docs/5.1/examples/starter-template/starter-template.css']),
	),
	HtmlTag::body(
		HtmlTag::div(
			['class'=>'col-lg-8 mx-auto p-3 py-md-5'],

			HtmlTag::header(
				['class' => 'd-flex align-items-center pb-3 mb-5 border-bottom'],
				HtmlTag::a(
					['class' => 'd-flex align-items-center text-dark text-decoration-none'],
					HtmlTag::span(['class'=>'fs-4'],'Php EasyTag Creator')
				)
			),

			HtmlTag::main(
				HtmlTag::h1('Get started with Bootstrap'),
				HtmlTag::p(
					['class' => 'fs-5 col-md-8'],
					"Quickly and easily get started with Bootstrap's compiled, production-ready files with this barebones example featuring some basic HTML and helpful links. Download all our examples to get started."
				),
				HtmlTag::p(
					['class' => 'mb-5'],
					HtmlTag::a(['href'=>'','class'=>'btn btn-primary btn-lg px-4'],'Download examples')
				),
				HtmlTag::hr(['class'=>'col-3 col-md-2 mb-5']),

				HtmlTag::div(['class'=>'row g-5'],
							 HtmlTag::div(['class'=>'col-md-6'],
										  HtmlTag::h2('Contact'),
										  HtmlTag::p('If you are a software developer, feel free to contact.'),
										  HtmlTag::ul(
											  ['class' => 'icon-list'],
											  HtmlTag::li(HtmlTag::a(['href'=>'https://github.com/emreuyguc'],'Github @emreuyguc')),
											  HtmlTag::li(HtmlTag::a(['href'=>'https://linkedin.com/in/emre-utku-uyguc'],'Linkedin @emre-utku-uyguc')),
										  )
							 ),

							 HtmlTag::div(['class'=>'col-md-6'],
										  HtmlTag::h2('Other Packages and Download'),
										  HtmlTag::p('The best way to contribute to each other.'),
										  HtmlTag::ul(['class'=>'icon-list'],
													  HtmlTag::li(HtmlTag::a(['href'=>''],'Php EasyTag creator')),
													  HtmlTag::li(HtmlTag::a(['href'=>'https://github.com/emreuyguc/Flutter_digital_lcd_widget'],'Flutter Digital Lcd Widget')),
													  HtmlTag::li(HtmlTag::a(['href'=>'https://github.com/emreuyguc/flutter_animated_sliced_button'],'Flutter Animated Sliced Button Widget')),
													  HtmlTag::li(HtmlTag::a(['href'=>'https://github.com/emreuyguc/prestashop-module-boilerplate'],'Prestashop Module Boiler Plate')),
										  )
							 ),
				)
			),


			HtmlTag::footer(
				['class'=>'pt-5 my-5 text-muted border-top'],
				'Created with php-easytag'
			),

		),
		HtmlTag::script(['src'=>'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js' , 'crossorigin'=>'anonymous'])
	)
);