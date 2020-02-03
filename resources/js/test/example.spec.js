import Login from "../components/auth/Login";

const lib = require('@vue/test-utils');

describe('HelloWorld.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message';

    lib.shallowMount(Login);

    expect(msg).toMatch(msg)
  })
});
