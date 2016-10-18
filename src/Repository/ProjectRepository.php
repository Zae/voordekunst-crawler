<?php

namespace Vpl\VdkCrawler\Repository;

use Vpl\VdkCrawler\Entity\Project;
use Vpl\VdkCrawler\Exception\VdkRepositoryException;

class ProjectRepository
{
    /**
     * @var \PDO
     */
    private $pdo;

    private $tableName;

    public function __construct(\PDO $pdo, $tableName='projects')
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
    }

    /**
     * @param Project $project
     * @return bool true on success
     * @throws VdkRepositoryException
     */
    public function save(Project $project)
    {
        try {
            $sql = sprintf('INSERT INTO wp_vdk_projects (
                project_id,
                created_at,
                title,
                donated_amount,
                goal_amount,
                num_donors,
                percentage_donated,
                num_days_left,
                url
            ) VALUES (
                :projectId,
                :createdAt,
                :title,
                :donatedAmount,
                :goalAmount,
                :numDonors,
                :percentageDonated,
                :numDaysLeft,
                :url
            )', $this->tableName);

            $createdAt = new \DateTime();
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':projectId', $project->getProjectId(), \PDO::PARAM_INT);
            $stmt->bindValue(':createdAt', $createdAt->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $stmt->bindValue(':title', $project->getTitle(), \PDO::PARAM_STR);
            $stmt->bindValue(':donatedAmount', $project->getDonatedAmount(), \PDO::PARAM_STR);
            $stmt->bindValue(':goalAmount', $project->getGoalAmount(), \PDO::PARAM_STR);
            $stmt->bindValue(':numDonors', $project->getNumDonors(), \PDO::PARAM_INT);
            $stmt->bindValue(':percentageDonated', $project->getPercentageDonated(), \PDO::PARAM_INT);
            $stmt->bindValue(':numDaysLeft', $project->getNumDaysLeft(), \PDO::PARAM_INT);
            $stmt->bindValue(':url', $project->getProjectUrl(), \PDO::PARAM_STR);
            $stmt->execute();
        } catch (\Exception $e) {
            throw new VdkRepositoryException($e->getMessage());
        }
        return true;
    }
}
