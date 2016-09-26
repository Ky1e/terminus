<?php

namespace Pantheon\Terminus\Commands\Multidev;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Pantheon\Terminus\Commands\TerminusCommand;
use Terminus\Collections\Sites;

class ListCommand extends TerminusCommand
{
    /**
     * Lists the the multidev environments belonging to the given site
     *
     * @authorized
     *
     * @name multidev:list
     * @aliases multidevs
     *
     * @return RowsOfFields
     *
     * @field-labels
     *   id: ID/Name
     *   created: Created
     *   domain: Domain
     *   onserverdev: OnServer Dev?
     *   locked: Locked?
     *   initialized: Initialized?
     *
     * @param string $site_name Name of the site to list multidev environments of
     *
     * @return RowsOfFields
     *
     * @usage terminus multidev:list awesome-site
     *   Display a list of multidev environments on awesome-site
     */
    public function listMultidevs($site_name)
    {
        $sites = new Sites();
        $site = $sites->get($site_name);
        $envs = array_map(
            function ($environment) {
                return $environment->serialize();
            },
            $site->environments->multidev()
        );

        if (empty($envs)) {
            $this->log()->warning('You have no multidev environments.');
        }

        // Return the output data.
        return new RowsOfFields($envs);
    }
}
