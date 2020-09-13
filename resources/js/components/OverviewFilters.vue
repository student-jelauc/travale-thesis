<template>
    <div class="row">
        <div class="col">
            <v-select v-model="accommodation_id" name="accommodation_id" route-name="accommodations.select"
                      placeholder="Select Accommodation"></v-select>
        </div>
        <div class="col">
            <v-select v-model="room_type_id" name="room_type_id" route-name="room.types.select"
                      placeholder="Select Room Types"
                      multiple></v-select>
        </div>
        <div class="col">
            <v-select v-model="facility_id" name="facility_id" route-name="facilities.select"
                      placeholder="Select Facility"
                      multiple></v-select>
        </div>
        <div class="col">
            <v-select v-model="floor" name="floor" route-name="rooms.floors"
                      placeholder="Select Floor"
                      multiple></v-select>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OverviewFilters",
        data: () => {
            let queryParams = queryString.parse(location.search, {arrayFormat: 'bracket'});

            return {
                accommodation_id: queryParams.accommodation_id || '',
                room_type_id: queryParams.room_type_id || '',
                facility_id: queryParams.facility_id || '',
                floor: queryParams.floor || '',
            }
        },

        mounted() {
            this.$watch(vm => [vm.accommodation_id, vm.room_type_id, vm.facility_id, vm.floor], val => {
                VueEvent.$emit('query-filters', {
                    params: {
                        accommodation_id: this.accommodation_id,
                        room_type_id: this.room_type_id,
                        facility_id: this.facility_id,
                        floor: this.floor,
                    }
                });
            });
        }
    }
</script>
