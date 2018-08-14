import { createElement } from '@plesk/plesk-ext-sdk';
import { shallow } from 'enzyme';
import Overview from '../Overview';

describe('Overview', () => {
    it('renders correctly', () => {
        const wrapper = shallow(
            <Overview baseUrl="/" />
        );
        expect(wrapper).toMatchSnapshot();
    });
});
