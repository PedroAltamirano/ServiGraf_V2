if (document.querySelector('.dropify')) {
	$('.dropify').dropify({
		tpl: {
			wrap: '<div class="dropify-wrapper user"></div>',
			loader: '<div class="dropify-loader"></div>',
			message:
				'<div class="dropify-message"><span class="file-icon"></span> <p class="text-uppercase">Arrastra y suelta aquí para subir</p><button type="button" class="mt-3 cs-file-drop-btn btn btn-primary btn-sm">O seleccione archivo</button></div>',
			preview:
				'<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message fs-12">Arrastra y suelta o haz clic para reemplazar</p></div></div></div>',
			filename:
				'<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
			clearButton: '<button type="button" class="dropify-clear">Quitar</button>',
			errorLine: '<p class="dropify-error">{{ error }}</p>',
			errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>',
		},
		error: {
			fileSize: 'El tamaño del archivo es demasiado grande ({{ value }}B máximo).',
			minWidth: 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
			maxWidth: 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
			minHeight: 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
			maxHeight: 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
			imageFormat: 'El formato de imagen no está permitido ({{ value }} solamente).',
		},
		messages: {
			default: 'Arrastre y suelte un archivo aquí o haga clic en',
			replace: 'Arrastra y suelta o haz clic para reemplazar',
			remove: 'Eliminar',
			error: 'Tenemos problemas con a imagen a cargar',
		},
	});
}
