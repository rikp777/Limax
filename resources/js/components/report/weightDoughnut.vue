<template>
    <div class="card">
        <div class="card-img-bottom">
            <chartjs-doughnut
                :bind="true"
                :datasets="datasets"
                :labels="labels"
                :option="option"
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "weightDoughnut",
        data() {
            return {
                datasets: [
                    {
                        data: [3, 20, 400, 324, 34, 90],
                        backgroundColor: ["#f36e60", "#ffdb3b", "#185190"],
                        hoverBackgroundColor: ["#fbd2cd", "#fef5c9", "#d1e3f7"]
                    }
                ],
                labels: ["Fijn", "Middel", "Reuzen", "Industrie", "Extra Fijn", "Snijden"],
                option: {}
            };
        }
    }
</script>

<style scoped>

</style>
