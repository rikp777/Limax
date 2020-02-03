//TODO
// Tom als je gewoon imports/exports wil gebruiken inplaats van require dan moet je effe
// naar deze link gaan https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-unit-jest
// onderaan staat tranform dependencies from /nodemodule deze kun je vinden in de package.json onder het kopje  "Jest"
// hier moet je kijken naar de usage of ES6 import / export
// Tests runnen nu goed alleen, als hij alle files checkt voor de covarage
// dan ziet hij overal import of export staan, maar dat kent die niet in de oude javascript versie.
// Dus moet je ergens aangeven gebruik ES6, de nieuwe versie

const shallowMount = require('@vue/test-utils'); // moet veranders worden naar #import { shallowMount} from "@vue/test-utils"

describe('Test', () => {
    it('checks if tests run', () => {
        const msg = 'new message';
        expect(msg).toMatch(msg)
    })
})
