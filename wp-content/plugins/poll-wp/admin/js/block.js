(function(blocks, editor, element) {
	var createElement = element.createElement
	var BlockControls = wp.blockEditor.BlockControls
	var SelectControl = wp.components.SelectControl
	var Placeholder   = wp.components.Placeholder
	var tspoll_list   = ts_poll_gutenberg_script_data.tspoll_list
	let el            = wp.element.createElement
	let Fragment      = wp.element.Fragment

	if (ts_poll_gutenberg_script_data.polls_count >= 1) {
		blocks.registerBlockType(
			'tspoll/poll-block',
			{
				title: 'TS Poll',
				icon: 'chart-bar',
				category: 'widgets',
				description: ts_poll_gutenberg_script_data.tspoll_plugin_desc,
				keywords: ['poll', 'question', 'answer', 'video poll', 'image poll', 'wordpress poll'],
				example: {
					attributes: {
						"preview": true,
					},
				},
				edit: props => {
					if (props.attributes.preview) {
						return [
						createElement(
							Fragment,
							{
								key: "ts-poll-preview-control",
								className: "ts-poll-preview-control",
								},
							el(
								'img',
								{
									src: ts_poll_gutenberg_script_data.ts_poll_preview,
									width: '100%',
									height: '100%'
									},
							),
						),
						]
					} else if (props.attributes.tsp_id) {

						return [
						createElement(
							BlockControls,
							{
								key: 'ts-poll-control'
								},
							createElement(
								SelectControl,
								{
									className: 'ts_poll_select_block',
									value: props.attributes.tsp_id,
									options: tspoll_list,
									onChange: function(newValue) {
										if (parseInt( newValue ) > 0) {
											props.setAttributes( { tsp_id: newValue } );
											createElement(
												wp.serverSideRender,
												{
													key: 'ts-poll-control',
													block: 'tspoll/poll-block',
													className: 'tspoll_guttenberg_block',
													attributes: props.attributes,
												}
											);
										} else {
											props.setAttributes( { tsp_id: '' } );
										}
									}
									}
							),
						),
						createElement(
							wp.serverSideRender,
							{
								key: 'ts-poll-control',
								block: 'tspoll/poll-block',
								className: 'tspoll_guttenberg_block',
								attributes: props.attributes,
							}
						),
						]
					} else {
						return [
						createElement(
							Placeholder,
							{
								key: "tspoll_selector_block",
								className: "tspoll_selector_block",
								},
							el(
								'img',
								{
									width: 100,
									height: 100,
									src: ts_poll_gutenberg_script_data.ts_poll_logo
									},
							),
							el(
								'h3',
								{
									key: "ts_poll_h3",
									className: "ts_poll_h3",
									},
								'TS Poll'
							),
							createElement(
								SelectControl,
								{
									className: 'ts_poll_select_block',
									value: props.attributes.tsp_id,
									options: tspoll_list,
									onChange: function(newValue) {
										if (parseInt( newValue ) > 0) {
											props.setAttributes( { tsp_id: newValue } );
											createElement(
												wp.serverSideRender,
												{
													key: 'ts-poll-control',
													block: 'tspoll/poll-block',
													className: 'tspoll_guttenberg_block',
													attributes: props.attributes,
												}
											)
										} else {
											props.setAttributes( { tsp_id: '' } );
										}
									}
									}
							),
						),
						]
					}
				},
				save: props => {
					return null;
				},
			}
		)
	} else {
		return null;
	}
}(
	window.wp.blocks,
	window.wp.editor,
	window.wp.element
))
