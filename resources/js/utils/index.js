export const addCommas = nStr => {
    nStr += ''
    var x = nStr.split('.')
    var x1 = x[0]
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2')
    }
    return x1 + x2
};

export const mapOrder = (array, order, key) => {
    array.sort(function (a, b) {
        var A = a[key];
        var B = b[key];
        if (order.indexOf(A + '') > order.indexOf(B + '')) {
            return 1
        } else {
            return -1
        }
    });
    return array
};

export const getDateWithFormat = () => {
    const today = new Date()
    let dd = today.getDate()
    let mm = today.getMonth() + 1 // January is 0!

    var yyyy = today.getFullYear()
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    return dd + '.' + mm + '.' + yyyy
};

export const getCurrentTime = () => {
    const now = new Date()
    return now.getHours() + ':' + now.getMinutes()
};

export const ThemeColors = () => {
    let rootStyle = getComputedStyle(document.body)
    // console.log('start')
    // console.log(localStorage.getItem('themeColor'))
    if (localStorage.getItem('themeColor') === 'light.orange') {
        // console.log('light.orange')
        return {
            themeColor1: "#f18024",
            themeColor2: "#e7523e",
            themeColor3: "#d6a779",
            themeColor4: "#dba070",
            themeColor5: "#f6c797",
            themeColor6: "#d6cdca",
            themeColor1_10: "rgba(241, 128, 36, 0.1)",
            themeColor2_10: "rgba(231, 82, 62, 0.1)",
            themeColor3_10: "rgba(214, 167, 121, 0.1)",
            themeColor4_10: "rgba(214, 167, 121, 0.1)",
            themeColor5_10: "rgba(214, 167, 121, 0.1)",
            themeColor6_10: "rgba(214, 167, 121, 0.1)",
            primaryColor: "#212121",
            foregroundColor: "white",
            separatorColor: "#d7d7d7",
        }
    }
    if (localStorage.getItem('themeColor') === 'dark.orange') {
        // console.log('dark.orange')
        return {
            themeColor1: "#c0702f",
            themeColor2: "#aa4f43",
            themeColor3: "#d6a779",
            themeColor4: "#dba070",
            themeColor5: "#f6c797",
            themeColor6: "#d6cdca",
            themeColor1_10: "rgba(192, 112, 47, 0.1)",
            themeColor2_10: "rgba(170, 79, 67, 0.1)",
            themeColor3_10: "rgba(214, 167, 121, 0.1)",
            themeColor4_10: "rgba(214, 167, 121, 0.1)",
            themeColor5_10: "rgba(214, 167, 121, 0.1)",
            themeColor6_10: "rgba(214, 167, 121, 0.1)",
            primaryColor: "#969696",
            foregroundColor: "#232223",
            separatorColor: "#424242",
        }
    } else {
        return {
            themeColor1: "#f18024",
            themeColor2: "#e7523e",
            themeColor3: "#d6a779",
            themeColor4: "#dba070",
            themeColor5: "#f6c797",
            themeColor6: "#d6cdca",
            themeColor1_10: "rgba(241, 128, 36, 0.1)",
            themeColor2_10: "rgba(231, 82, 62, 0.1)",
            themeColor3_10: "rgba(214, 167, 121, 0.1)",
            themeColor4_10: "rgba(214, 167, 121, 0.1)",
            themeColor5_10: "rgba(214, 167, 121, 0.1)",
            themeColor6_10: "rgba(214, 167, 121, 0.1)",
            primaryColor: "#212121",
            foregroundColor: "white",
            separatorColor: "#d7d7d7",
        }
    }


    // console.log(rootStyle.getPropertyValue('--primary-color').trim())
    // return {
    //     themeColor1: rootStyle.getPropertyValue('--theme-color-1').trim(),
    //     themeColor2: rootStyle.getPropertyValue('--theme-color-2').trim(),
    //     themeColor3: rootStyle.getPropertyValue('--theme-color-3').trim(),
    //     themeColor4: rootStyle.getPropertyValue('--theme-color-4').trim(),
    //     themeColor5: rootStyle.getPropertyValue('--theme-color-5').trim(),
    //     themeColor6: rootStyle.getPropertyValue('--theme-color-6').trim(),
    //     themeColor1_10: rootStyle.getPropertyValue('--theme-color-1-10').trim(),
    //     themeColor2_10: rootStyle.getPropertyValue('--theme-color-2-10').trim(),
    //     themeColor3_10: rootStyle.getPropertyValue('--theme-color-3-10').trim(),
    //     themeColor4_10: rootStyle.getPropertyValue('--theme-color-3-10').trim(),
    //     themeColor5_10: rootStyle.getPropertyValue('--theme-color-3-10').trim(),
    //     themeColor6_10: rootStyle.getPropertyValue('--theme-color-3-10').trim(),
    //     primaryColor: rootStyle.getPropertyValue('--primary-color').trim(),
    //     foregroundColor: rootStyle.getPropertyValue('--foreground-color').trim(),
    //     separatorColor: rootStyle.getPropertyValue('--separator-color').trim()
    // }
};

export const chartTooltip = {
    backgroundColor: "#232223",
    titleFontColor: "#969696",
    borderColor: "#424242",
    borderWidth: 0.5,
    bodyFontColor: "#969696",
    bodySpacing: 10,
    xPadding: 15,
    yPadding: 15,
    cornerRadius: 0.15
}

export const centerTextPlugin = {
    afterDatasetsUpdate: function (chart) {
    },
    beforeDraw: function (chart) {
        var width = chart.chartArea.right
        var height = chart.chartArea.bottom
        var ctx = chart.chart.ctx
        ctx.restore()

        var activeLabel = chart.data.labels[0];
        var activeValue = chart.data.datasets[0].data[0];
        var dataset = chart.data.datasets[0];
        var meta = dataset._meta[Object.keys(dataset._meta)[0]];
        var total = meta.total;

        var activePercentage = parseFloat(((activeValue / total) * 100).toFixed(1))
        activePercentage = chart.legend.legendItems[0].hidden
            ? 0
            : activePercentage

        if (chart.pointAvailable) {
            activeLabel = chart.data.labels[chart.pointIndex];
            activeValue =
                chart.data.datasets[chart.pointDataIndex].data[chart.pointIndex];

            dataset = chart.data.datasets[chart.pointDataIndex];
            meta = dataset._meta[Object.keys(dataset._meta)[0]];
            total = meta.total
            activePercentage = parseFloat(((activeValue / total) * 100).toFixed(1))
            activePercentage = chart.legend.legendItems[chart.pointIndex].hidden
                ? 0
                : activePercentage
        }

        ctx.font = '36px Nunito, sans-serif';
        ctx.fillStyle = ThemeColors().primaryColor;
        ctx.textBaseline = 'middle';

        var text = activePercentage + '%';
        var textX = Math.round((width - ctx.measureText(text).width) / 2);
        var textY = height / 2;
        ctx.fillText(text, textX, textY);

        ctx.font = '14px Nunito, sans-serif';
        ctx.textBaseline = 'middle';

        var text2 = activeLabel;
        var textX2 = Math.round((width - ctx.measureText(text2).width) / 2);
        var textY2 = height / 2 - 30;
        ctx.fillText(text2, textX2, textY2);

        ctx.save()
    },
    beforeEvent: function (chart, event, options) {
        var firstPoint = chart.getElementAtEvent(event)[0];

        if (firstPoint) {
            chart.pointIndex = firstPoint._index;
            chart.pointDataIndex = firstPoint._datasetIndex;
            chart.pointAvailable = true;
        }
    }
};
