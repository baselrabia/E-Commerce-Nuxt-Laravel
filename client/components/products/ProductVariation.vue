<template>
	<div class="field">
		<label :for="type" class="label">
			{{ type }}
		</label>

		<div class="control">
			<div class="select is-fullwidth">
				<select
					@change="changed($event, type)"
				>
					<option value="">Please choose...</option>

					<option
						v-for="variation in variations"
						:key="variation.id"
						:value="variation.id"
					>
						{{ variation.name }}

						<template v-if="variation.price_varies">
							({{ variation.price }})
						</template>

					</option>
				</select>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			type: {
				required: true,
				type: String
			},
			variations: {
				required: true,
				type: Array
			},
		},

		methods: {
			changed (e, type) {
				this.$emit('input', this.findVariation(e.target.value))
			},
			findVariation (id) {
				let variation = this.variations.find(v => v.id == id)
				if (typeof variation === 'undefined') {
					return null
				}
				return variation
			}
		}
	}
</script>
