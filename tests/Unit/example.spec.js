// Tom als je gewoon imports wil gebruiker inplaats van require dan moet je effe
// naar deze link gaan https://github.com/vuejs/vue-cli/tree/dev/packages/%40vue/cli-plugin-unit-jest
// onderaan staat tranform dependencies from /nodemodule
// hier moet je kijken naar de usage of ES6 import / export

const shallowMount = require('@vue/test-utils');

describe('HelloWorld.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message';
    expect(msg).toMatch(msg)
  })
})
