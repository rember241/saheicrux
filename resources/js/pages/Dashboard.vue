<template>
<div>
      <v-breadcrumbs :items="breadcrums">
    <template v-slot:item="{ item }">
      <v-breadcrumbs-item
        :href="item.href"
        :disabled="item.disabled"
      >
        {{ item.text.toUpperCase() }}
      </v-breadcrumbs-item>
    </template>
  </v-breadcrumbs>

  <v-container>
		<v-row dense class="pb-10">
			<v-col v-for="(item, i) in items" :key="i" cols="3">
				<v-card :color="item.color" elevation="5" dark outlined shaped>
					<div class="d-flex flex-no-wrap justify-space-between">
						<div>
							<v-card-title class="text-h6" v-text="item.title"></v-card-title>
							<v-card-subtitle class="text-h4" v-text="item.value"></v-card-subtitle>
							<v-card-actions>
								<v-btn class="ml-2 mt-5" outlined rounded small> View Data </v-btn>
							</v-card-actions>
						</div>
						<v-avatar class="ma-3" size="125" tile>
							<v-icon size="80" color="white">
								{{item.icon}}
							</v-icon>
						</v-avatar>
					</div>
				</v-card>
			</v-col>
		</v-row>
        <v-row>
           <v-col cols="6">
            <v-card class="elevation-5 pa-5 mb-10">
                    <v-sparkline
                        :value="value"
                        :gradient="gradient"
                        :smooth="radius || false"
                        :padding="padding"
                        :line-width="width"
                        :stroke-linecap="lineCap"
                        :gradient-direction="gradientDirection"
                        :fill="fill"
                        :type="type"
                        :auto-line-width="autoLineWidth"
                        auto-draw
                    ></v-sparkline>
            </v-card>
           </v-col>
           <v-col cols="6">
            <v-card class="elevation-5 pa-5 mb-10">
                    <v-sparkline
                        :value="value"
                        :gradient="gradient"
                        :smooth="radius || false"
                        :padding="padding"
                        :line-width="width"
                        :stroke-linecap="lineCap"
                        :gradient-direction="gradientDirection"
                        :fill="fill"
                        :type="type"
                        :auto-line-width="autoLineWidth"
                        auto-draw
                    ></v-sparkline>
            </v-card>
           </v-col>
        </v-row>

<v-card class="elevation-5 pa-5">
    <v-simple-table height="300px">
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Name
          </th>
          <th class="text-left">
            Calories
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in desserts"
          :key="item.name"
        >
          <td>{{ item.name }}</td>
          <td>{{ item.calories }}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</v-card>

</v-container>
</div>

</template>
<script>
  const gradients = [
    ['#222'],
    ['#42b3f4'],
    ['red', 'orange', 'yellow'],
    ['purple', 'violet'],
    ['#00c6ff', '#F0F', '#FF0'],
    ['#f72047', '#ffd200', '#1feaea'],
  ]
export default {
    		data: () => ({
        breadcrums: [
        {
          text: 'Home',
          disabled: false,
          href: '/',
        },
        {
          text: 'Dashboard',
          disabled: false,
        },
      ],
      width: 2,
      radius: 10,
      padding: 8,
      lineCap: 'round',
      gradient: gradients[5],
      value: [0, 2, 5, 9, 5, 10, 3, 5, 0, 0, 1, 8, 2, 9, 0],
      gradientDirection: 'top',
      gradients,
      fill: false,
      type: 'trend',
      autoLineWidth: false,
            items: [{
				color: '#FC9309',
				value: '2',
				title: 'Card 1',
				icon: 'mdi-account-supervisor'
			}, {
				color: '#17BCD0',
				value: '100',
				title: 'Card 2',
				icon: 'mdi-store'
			}, {
				color: '#49A44D',
				value: '20',
				title: 'Card 3',
				icon: 'mdi-check'
			}, {
				color: '#EE504D',
				value: '10',
				title: 'Card 4',
				icon: 'mdi-alpha-p'
			}, ],

            desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
          },
          {
            name: 'Eclair',
            calories: 262,
          },
          {
            name: 'Cupcake',
            calories: 305,
          },
          {
            name: 'Gingerbread',
            calories: 356,
          },
          {
            name: 'Jelly bean',
            calories: 375,
          },
          {
            name: 'Lollipop',
            calories: 392,
          },
          {
            name: 'Honeycomb',
            calories: 408,
          },
          {
            name: 'Donut',
            calories: 452,
          },
          {
            name: 'KitKat',
            calories: 518,
          },
        ],
            })
}
</script>