/**
 * GitHub Repo Card Block Editor
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	TextControl,
	ToggleControl,
	Button,
	Spinner,
	Notice,
} from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

/**
 * Edit component for GitHub Repo Card block.
 *
 * @param {Object} props Block props.
 * @param {Object} props.attributes Block attributes.
 * @param {Function} props.setAttributes Set attributes function.
 * @return {JSX.Element} Block editor component.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { username, repoName, showTopics, showStats, cacheData } = attributes;
	const [ isLoading, setIsLoading ] = useState( false );
	const [ error, setError ] = useState( null );

	const blockProps = useBlockProps( {
		className: 'github-repo-card-block',
	} );

	/**
	 * Fetch repository data from API.
	 */
	const fetchRepoData = async () => {
		if ( ! username || ! repoName ) {
			setError( 'Please enter both username and repository name.' );
			return;
		}

		setIsLoading( true );
		setError( null );

		try {
			const response = await apiFetch( {
				path: `/devengine/v1/github/repos?username=${ encodeURIComponent( username ) }&repo=${ encodeURIComponent( repoName ) }`,
			} );

			if ( response && ! response.error ) {
				setAttributes( { cacheData: response } );
			} else {
				setError( response?.message || 'Failed to fetch repository data.' );
			}
		} catch ( err ) {
			setError( err.message || 'An error occurred while fetching data.' );
		} finally {
			setIsLoading( false );
		}
	};

	// Render preview or placeholder.
	const renderPreview = () => {
		if ( cacheData && cacheData.name ) {
			return (
				<article className="card card--repo">
					<header className="card__header">
						<h3 className="card__title">
							<a href={ cacheData.html_url } target="_blank" rel="noopener noreferrer">
								{ cacheData.name }
							</a>
						</h3>
						{ cacheData.language && (
							<span className="badge badge--tech badge--{ cacheData.language.toLowerCase() }">
								{ cacheData.language }
							</span>
						) }
						{ cacheData.visibility && (
							<span className="badge badge--visibility">
								{ cacheData.visibility }
							</span>
						) }
					</header>
					<div className="card__body">
						{ cacheData.description && (
							<p className="card__description">{ cacheData.description }</p>
						) }
						{ showTopics && cacheData.topics && cacheData.topics.length > 0 && (
							<div className="repo-topics">
								{ cacheData.topics.map( ( topic, index ) => (
									<span key={ index } className="badge badge--tech">
										{ topic }
									</span>
								) ) }
							</div>
						) }
						{ cacheData.updated_at && (
							<p className="card__meta">
								Updated: { new Date( cacheData.updated_at ).toLocaleDateString() }
							</p>
						) }
					</div>
					{ showStats && (
						<footer className="card__footer">
							<div className="repo-stats">
								<span className="stat-item">
									⭐ { cacheData.stargazers_count || 0 }
								</span>
								<span className="stat-item">
									🍴 { cacheData.forks_count || 0 }
								</span>
							</div>
							<a
								href={ cacheData.html_url }
								target="_blank"
								rel="noopener noreferrer"
								className="btn btn--primary"
							>
								View on GitHub
							</a>
						</footer>
					) }
				</article>
			);
		}

		return (
			<div className="card card--repo card--placeholder">
				<header className="card__header">
					<h3 className="card__title">
						{ repoName || 'Repository Name' }
					</h3>
					{ username && <p className="card__meta">by { username }</p> }
				</header>
				<div className="card__body">
					<p className="card__description">
						Click "Fetch Preview" to load repository data from GitHub API.
					</p>
				</div>
			</div>
		);
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title="GitHub Repository Settings">
					<TextControl
						label="GitHub Username"
						value={ username }
						onChange={ ( value ) => setAttributes( { username: value } ) }
						help="Enter the GitHub username"
					/>
					<TextControl
						label="Repository Name"
						value={ repoName }
						onChange={ ( value ) => setAttributes( { repoName: value } ) }
						help="Enter the repository name"
					/>
					<ToggleControl
						label="Show Topics"
						checked={ showTopics }
						onChange={ ( value ) => setAttributes( { showTopics: value } ) }
					/>
					<ToggleControl
						label="Show Stats"
						checked={ showStats }
						onChange={ ( value ) => setAttributes( { showStats: value } ) }
					/>
					<Button
						variant="primary"
						onClick={ fetchRepoData }
						disabled={ isLoading || ! username || ! repoName }
					>
						{ isLoading ? 'Fetching...' : 'Fetch Preview' }
					</Button>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				{ error && (
					<Notice status="error" isDismissible={ false }>
						{ error }
					</Notice>
				) }
				{ isLoading && (
					<div className="loading-spinner">
						<Spinner />
					</div>
				) }
				{ ! isLoading && renderPreview() }
			</div>
		</>
	);
}

