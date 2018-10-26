import { createElement, Component, Alert, AuxiliaryActions, Translate, PropTypes, Link, Fragment } from '@plesk/plesk-ext-sdk';
import axios from 'axios';

export default class Overview extends Component {
    static propTypes = {
        baseUrl: PropTypes.string.isRequired,
    };

    state = {
        date: null,
    };

    componentDidMount() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/date`).then(({ data }) => this.setState({ date: data }));
    }

    render() {
        const { date } = this.state;

        if (!date) {
            return null;
        }

        return (
            <Fragment>
                <Alert intent="danger">
                    <Translate content="Overview.message" params={{ date }} />
                </Alert>
                <p>
                    <AuxiliaryActions>
                        <Link to="/overview/list"><Translate content="Overview.listExample" /></Link>
                        <Link to="/overview/form"><Translate content="Overview.formExample" /></Link>
                    </AuxiliaryActions>
                </p>
            </Fragment>
        );
    }
}
